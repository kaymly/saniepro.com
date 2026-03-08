<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\Contracts\CreateOrUpdateProductOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\Contracts\ListProductsOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\Contracts\ReadProductOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Responses\Contracts\CreateOrUpdateProductResponseContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Responses\Contracts\ListProductsResponseContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Responses\Contracts\ReadProductResponseContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\MissingProductRemoteIdException;

/**
 * Contract for catalog product services.
 */
interface ProductsServiceContract
{
    /**
     * Creates or updates a product.
     *
     * @param CreateOrUpdateProductOperationContract $operation
     * @return CreateOrUpdateProductResponseContract
     */
    public function createOrUpdateProduct(CreateOrUpdateProductOperationContract $operation) : CreateOrUpdateProductResponseContract;

    /**
     * Creates a product.
     *
     * @param CreateOrUpdateProductOperationContract $operation
     * @return CreateOrUpdateProductResponseContract
     */
    public function createProduct(CreateOrUpdateProductOperationContract $operation) : CreateOrUpdateProductResponseContract;

    /**
     * Reads a product.
     *
     * @param ReadProductOperationContract $operation
     * @return ReadProductResponseContract
     * @throws MissingProductRemoteIdException
     */
    public function readProduct(ReadProductOperationContract $operation) : ReadProductResponseContract;

    /**
     * Lists products.
     *
     * @param ListProductsOperationContract $operation
     * @return ListProductsResponseContract
     */
    public function listProducts(ListProductsOperationContract $operation) : ListProductsResponseContract;

    /**
     * Updates a product.
     *
     * @param CreateOrUpdateProductOperationContract $operation
     * @param string $remoteId
     * @return CreateOrUpdateProductResponseContract
     */
    public function updateProduct(CreateOrUpdateProductOperationContract $operation, string $remoteId) : CreateOrUpdateProductResponseContract;
}
