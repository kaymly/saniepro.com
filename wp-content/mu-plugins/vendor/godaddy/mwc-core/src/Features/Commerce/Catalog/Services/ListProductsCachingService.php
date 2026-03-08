<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services;

use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\Contracts\ListProductsOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductBase;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ListProductsCachingServiceContract;

/**
 * List products caching service.
 */
class ListProductsCachingService implements ListProductsCachingServiceContract
{
    /**
     * Determines if the operation can be cached. We can only cache operations where we're querying by `ids` only and no other params.
     *
     * @param ListProductsOperationContract $operation
     * @return bool
     */
    public function canCacheOperation(ListProductsOperationContract $operation) : bool
    {
        // @NOTE the toArray method in this context will remove empty key-value pairs from the array
        $queryArgs = $operation->toArray();

        return ! empty($queryArgs['ids']) && empty(ArrayHelper::except($queryArgs, ['ids']));
    }

    /**
     * Fetches products that are already cached.
     *
     * This is where we'd get cached products when filtering by ID.
     * So, if we're getting `product-123` we'd check local cache to see if we already have `product-123` cached.
     *
     * @param ListProductsOperationContract $operation
     * @return ProductBase[]
     */
    public function getCachedProductsFromOperation(ListProductsOperationContract $operation) : array
    {
        $remoteIds = $operation->getIds();

        if (empty($remoteIds) || ! ArrayHelper::accessible($remoteIds)) {
            return [];
        }

        // @TODO fetch products from cache by ID if they exist, in a future story (no story yet)
        return [];
    }

    /**
     * Determines if the operation is fully cached.
     *
     * @param ListProductsOperationContract $operation
     * @param ProductBase[] $cachedProducts
     * @return bool
     */
    public function isOperationFullyCached(ListProductsOperationContract $operation, array $cachedProducts) : bool
    {
        if (! $remoteIds = $operation->getIds()) {
            return false;
        }

        $cachedProductIds = array_column($cachedProducts, 'productId');

        // we only need to proceed with query execution if some requested IDs are not in cache
        return count(array_diff($remoteIds, $cachedProductIds)) === 0;
    }
}
