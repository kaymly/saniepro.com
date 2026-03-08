<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\Handlers;

use Exception;
use GoDaddy\WordPress\MWC\Common\Exceptions\SentryException;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\ProductReadInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\ReadProductOperation;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductPost;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataSources\Adapters\ProductPostAdapter;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ProductsServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\CommerceException;
use GoDaddy\WordPress\MWC\Core\Interceptors\Handlers\AbstractInterceptorHandler;
use stdClass;

/**
 * Callback handler for {@see ProductReadInterceptor}.
 */
class ProductReadHandler extends AbstractInterceptorHandler
{
    /** @var ProductsServiceContract */
    protected ProductsServiceContract $productsService;

    /** @var ProductPostAdapter */
    protected ProductPostAdapter $postAdapter;

    /**
     * Constructor.
     *
     * @param ProductsServiceContract $productsService
     * @param ProductPostAdapter $postAdapter
     */
    public function __construct(ProductsServiceContract $productsService, ProductPostAdapter $postAdapter)
    {
        $this->productsService = $productsService;
        $this->postAdapter = $postAdapter;
    }

    /**
     * Determines whether it should read a product post object from catalog.
     *
     * @param mixed|stdClass $post post object from wpdb
     * @return bool
     */
    protected function shouldRead($post) : bool
    {
        return is_object($post)
            && isset($post->post_type)
            && ArrayHelper::contains(['product', 'product_variation'], $post->post_type)
            && ! $this->isProductBeingEdited($post);
    }

    /**
     * Determines whether a product is currently being edited via the admin UI.
     * This check is necessary to prevent reading from the platform while we're in the process of editing a product.
     *
     * @TODO we should ideally find a better, more reliable way to disable reads during the edit process {agibson 2023-05-03}
     *
     * @param object $post
     * @return bool
     */
    protected function isProductBeingEdited(object $post) : bool
    {
        return isset($_REQUEST['_wpnonce']) && ! empty($post->ID) && wp_verify_nonce($_REQUEST['_wpnonce'], "update-post_{$post->ID}");
    }

    /**
     * Reads a product post object from catalog.
     *
     * @param array<int, mixed> $args arguments passed to the filter
     * @return stdClass|mixed the product post object from catalog or the original post object
     */
    public function run(...$args)
    {
        // not a product post object
        if (! $this->shouldRead($args[0])) {
            return $args[0];
        }

        /** @var stdClass $sourcePostObject */
        $sourcePostObject = $args[0];

        try {
            $productId = $sourcePostObject->ID ?? 0;

            if (! $productId) {
                throw new CommerceException('Invalid local product ID to build product post object from catalog.');
            }

            $operation = ReadProductOperation::seed(['localId' => $productId]);
            $productBase = $this->productsService->readProduct($operation)->getProduct();
            $productPost = $this->postAdapter->convertToSource($productBase);

            // in theory at this point we should have a well-formed object if no exceptions were thrown, but this is a safety check
            if (! $productPost instanceof ProductPost) {
                throw new CommerceException("Could not build product post object from catalog for local product ID {$productId}.");
            }

            // overlays the source post object from the WordPress database with an object from Commerce catalog
            return $productPost->toDatabaseObject($sourcePostObject);
        } catch (Exception $exception) {
            new SentryException($exception->getMessage(), $exception);

            // return the original post object as-is
            return $args[0];
        }
    }
}
