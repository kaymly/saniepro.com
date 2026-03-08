<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services;

use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\Contracts\ListProductsOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\Contracts\CatalogProviderContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductAssociation;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductBase;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductRequestInputs\ListProductsInput;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ListProductsCachingServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ListProductsServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Models\Contracts\CommerceContextContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Repositories\ProductMapRepository;
use InvalidArgumentException;

/**
 * List products service.
 */
class ListProductsService implements ListProductsServiceContract
{
    /** @var ProductMapRepository */
    protected ProductMapRepository $productMapRepository;

    /** @var CommerceContextContract */
    protected CommerceContextContract $commerceContext;

    /** @var CatalogProviderContract */
    protected CatalogProviderContract $catalogProvider;

    /** @var ListProductsCachingServiceContract */
    protected ListProductsCachingServiceContract $cachingService;

    /**
     * Constructor.
     *
     * @param ProductMapRepository $productMapRepository
     * @param CommerceContextContract $commerceContext
     * @param CatalogProviderContract $catalogProvider
     * @param ListProductsCachingServiceContract $cachingService
     */
    public function __construct(
        ProductMapRepository $productMapRepository,
        CommerceContextContract $commerceContext,
        CatalogProviderContract $catalogProvider,
        ListProductsCachingServiceContract $cachingService
    ) {
        $this->productMapRepository = $productMapRepository;
        $this->commerceContext = $commerceContext;
        $this->catalogProvider = $catalogProvider;
        $this->cachingService = $cachingService;
    }

    /**
     * Lists the products.
     *
     * @param ListProductsOperationContract $operation
     * @return ProductAssociation[]
     * @throws BaseException|InvalidArgumentException
     */
    public function list(ListProductsOperationContract $operation) : array
    {
        $products = [];

        $this->convertLocalEntitiesToRemote($operation);

        if ($this->cachingService->canCacheOperation($operation)) {
            $products = $this->cachingService->getCachedProductsFromOperation($operation);
        }

        if ($this->cachingService->isOperationFullyCached($operation, $products)) {
            return $this->associateRemoteProductsWithLocalIds($products);
        }

        $products = $this->catalogProvider->products()->list($this->getListProductsInput($operation));

        // @TODO put all found products into cache (no story yet) {agibson 2023-04-06}

        return $this->associateRemoteProductsWithLocalIds($products);
    }

    /**
     * Converts local entities to remote. For example: convert local Woo product IDs to their remote counterparts.
     *
     * @param ListProductsOperationContract $operation
     * @return void
     * @throws BaseException|InvalidArgumentException
     */
    protected function convertLocalEntitiesToRemote(ListProductsOperationContract $operation) : void
    {
        if ($localIds = $operation->getLocalIds()) {
            $localAndRemoteIds = $this->productMapRepository->getIdsBy('local_id', $localIds);

            $remoteIds = TypeHelper::arrayOfStrings(ArrayHelper::combine(
                TypeHelper::array($operation->getIds(), []),
                array_column($localAndRemoteIds, 'commerce_id')
            ), false);

            $operation->setIds($remoteIds);
        }

        // @TODO once supported, we will also convert the category ID in this method (no story yet) {agibson 2023-04-06}
    }

    /**
     * Gets the list products input.
     *
     * Assembles data used to inform product list requests sent to the Catalog API.
     *
     * @param ListProductsOperationContract $listProductsOperation contains the query args to use to list products
     * @return ListProductsInput the DTO to use to list products
     */
    protected function getListProductsInput(ListProductsOperationContract $listProductsOperation) : ListProductsInput
    {
        return new ListProductsInput([
            'queryArgs' => $listProductsOperation->toArray(), // Note: this implementation of `toArray()` removes keys with null values.
            'storeId'   => $this->commerceContext->getStoreId(),
        ]);
    }

    /**
     * Associates remote products with local products' IDs.
     *
     * @param ProductBase[] $products
     * @return ProductAssociation[]
     */
    protected function associateRemoteProductsWithLocalIds(array $products) : array
    {
        $columnLocalId = $this->productMapRepository::COLUMN_LOCAL_ID;
        $columnCommerceId = $this->productMapRepository::COLUMN_COMMERCE_ID;

        $remoteProductIds = array_filter(array_column($products, 'productId'));
        $productAssociations = [];

        if (! empty($remoteProductIds)) {
            try {
                // strval mapping ensures that the productId values are strings, which is required by the repository method array shape
                $localAndRemoteIds = $this->productMapRepository->getIdsBy($columnCommerceId, array_map('strval', $remoteProductIds));

                foreach ($localAndRemoteIds as $localAndRemoteId) {
                    if (empty($localAndRemoteId[$columnLocalId]) || empty($localAndRemoteId[$columnCommerceId]) || ! is_numeric($localAndRemoteId[$columnLocalId])) {
                        continue;
                    }

                    $remoteProduct = ArrayHelper::where($products, fn (ProductBase $product) => $product->productId === $localAndRemoteId[$columnCommerceId], false)[0] ?? null;

                    if ($remoteProduct instanceof ProductBase) {
                        $productAssociations[] = ProductAssociation::getNewInstance([
                            'localId' => (int) $localAndRemoteId[$columnLocalId],
                            'product' => $remoteProduct,
                        ]);
                    }
                }
            } catch (InvalidArgumentException $exception) {
                // should never be thrown since we are passing the column value from the repository constant
            }
        }

        return $productAssociations;
    }
}
