<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\Contracts\ListProductsOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductBase;

/**
 * Contract for a service that can cache products from a list products operation.
 */
interface ListProductsCachingServiceContract
{
    /**
     * Determines if an operation can be cached.
     *
     * @param ListProductsOperationContract $operation
     * @return bool
     */
    public function canCacheOperation(ListProductsOperationContract $operation) : bool;

    /**
     * Gets cached products from an operation.
     *
     * @param ListProductsOperationContract $operation
     * @return ProductBase[]
     */
    public function getCachedProductsFromOperation(ListProductsOperationContract $operation) : array;

    /**
     * Determines if the operation has been fully cached.
     *
     * @param ListProductsOperationContract $operation
     * @param ProductBase[] $cachedProducts
     * @return bool
     */
    public function isOperationFullyCached(ListProductsOperationContract $operation, array $cachedProducts) : bool;
}
