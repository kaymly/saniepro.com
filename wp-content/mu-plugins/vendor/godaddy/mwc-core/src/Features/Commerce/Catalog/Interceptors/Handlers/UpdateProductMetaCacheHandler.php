<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\Handlers;

use Exception;
use GoDaddy\WordPress\MWC\Common\Exceptions\SentryException;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\ListProductsOperation;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductAssociation;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataSources\Adapters\ProductPostMetaAdapter;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ProductsServiceContract;
use GoDaddy\WordPress\MWC\Core\Interceptors\Handlers\AbstractInterceptorHandler;

/**
 * Update product meta cache handler.
 *
 * This handler will update the local product post meta cache with remote product metadata.
 */
class UpdateProductMetaCacheHandler extends AbstractInterceptorHandler
{
    /** @var ProductsServiceContract */
    protected ProductsServiceContract $productService;

    /**
     * Constructor.
     *
     * @param ProductsServiceContract $productService
     */
    public function __construct(ProductsServiceContract $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Updates local product meta cache with remote product meta.
     *
     * @param array<int, mixed> $args hook arguments
     * @return array<int, array<string, array<mixed>>> cache data
     */
    public function run(...$args) : array
    {
        /** @var array<int, array<string, array<mixed>>> $cache */
        $cache = TypeHelper::array($args[0] ?? [], []);
        $objectIds = TypeHelper::arrayOfIntegers($args[1] ?? []);
        $metaType = TypeHelper::string($args[2] ?? '', '');

        if (! $this->shouldUpdate($metaType, $objectIds)) {
            return $cache;
        }

        try {
            $listProducts = $this->productService->listProducts(ListProductsOperation::seed(['localIds' => $objectIds]));
        } catch (Exception $exception) {
            new SentryException($exception->getMessage(), $exception);

            return $cache;
        }

        return $this->update($cache, $listProducts->getProducts());
    }

    /**
     * Determines whether the cache should be updated for a given set.
     *
     * @param string $metaType
     * @param int[] $objectIds local product IDs
     * @return bool
     */
    protected function shouldUpdate(string $metaType, array $objectIds) : bool
    {
        return 'post' === $metaType && ! empty($objectIds);
    }

    /**
     * Updates the cache metadata related to products.
     *
     * @param array<int, array<string, array<mixed>>> $cache
     * @param ProductAssociation[] $productAssociations
     * @return array<int, array<string, array<mixed>>> the updated cache
     */
    protected function update(array $cache, array $productAssociations) : array
    {
        foreach ($productAssociations as $productAssociation) {
            // merges the local product cached metadata with remote metadata from catalog
            $localMeta = $cache[$productAssociation->localId] ?? [];

            $cache[$productAssociation->localId] = array_merge(
                $localMeta,
                ProductPostMetaAdapter::getNewInstance($productAssociation->product)->setLocalMeta($localMeta)->convertFromSourceToFormattedArray()
            );
        }

        return $cache;
    }
}
