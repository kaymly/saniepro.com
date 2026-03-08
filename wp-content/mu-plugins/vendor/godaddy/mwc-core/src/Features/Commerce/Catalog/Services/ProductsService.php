<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services;

use Exception;
use GoDaddy\WordPress\MWC\Common\Exceptions\AdapterException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\Contracts\CreateOrUpdateProductOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\Contracts\ListProductsOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\Contracts\ReadProductOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\Contracts\CatalogProviderContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductBase;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductRequestInputs\CreateProductInput;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductRequestInputs\ReadProductInput;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductRequestInputs\UpdateProductInput;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataSources\Adapters\ProductBaseAdapter;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ListProductsServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ProductsMappingServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ProductsServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Responses\Contracts\CreateOrUpdateProductResponseContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Responses\Contracts\ListProductsResponseContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Responses\Contracts\ReadProductResponseContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Responses\CreateOrUpdateProductResponse;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Responses\ListProductsResponse;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Responses\ReadProductResponse;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\CommerceException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\Contracts\CommerceExceptionContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\MissingProductLocalIdException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\MissingProductRemoteIdException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\MissingProductRemoteIdForParentException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\ProductMappingNotFoundException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Models\Contracts\CommerceContextContract;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Models\Products\Product;

/**
 * Handles communication between Managed WooCommerce and the commerce catalog API for CRUD operations.
 */
class ProductsService implements ProductsServiceContract
{
    /** @var CommerceContextContract context of the current site - contains the store ID */
    protected CommerceContextContract $commerceContext;

    /** @var CatalogProviderContract provider to the external API's CRUD operations */
    protected CatalogProviderContract $productsProvider;

    /** @var ProductsMappingServiceContract service that handles mapping local entities to their remote equivalents */
    protected ProductsMappingServiceContract $productsMappingService;

    /** @var ListProductsServiceContract service to list products */
    protected ListProductsServiceContract $listProductsService;

    /**
     * Constructor.
     *
     * @param CommerceContextContract $commerceContext
     * @param CatalogProviderContract $productsProvider
     * @param ProductsMappingServiceContract $productsMappingService
     * @param ListProductsServiceContract $listProductsService
     */
    final public function __construct(
        CommerceContextContract $commerceContext,
        CatalogProviderContract $productsProvider,
        ProductsMappingServiceContract $productsMappingService,
        ListProductsServiceContract $listProductsService
    ) {
        $this->commerceContext = $commerceContext;
        $this->productsProvider = $productsProvider;
        $this->productsMappingService = $productsMappingService;
        $this->listProductsService = $listProductsService;
    }

    /**
     * Reads a product from the remote service.
     *
     * @param ReadProductOperationContract $operation
     * @return ReadProductResponseContract
     * @throws ProductMappingNotFoundException
     */
    public function readProduct(ReadProductOperationContract $operation) : ReadProductResponseContract
    {
        $remoteId = $this->productsMappingService->getRemoteId(Product::getNewInstance()->setId($operation->getLocalId()));

        if (! $remoteId) {
            throw new ProductMappingNotFoundException('No local mapping found for product.');
        }

        return ReadProductResponse::getNewInstance($this->productsProvider->products()->read($this->getReadProductInput($remoteId)));
    }

    /**
     * Gets the input for the create product operation.
     *
     * @param string $remoteId
     * @return ReadProductInput
     */
    protected function getReadProductInput(string $remoteId) : ReadProductInput
    {
        return ReadProductInput::getNewInstance([
            'productId' => $remoteId,
            'storeId'   => $this->commerceContext->getStoreId(),
        ]);
    }

    /**
     * Creates or updates the product.
     *
     * @param CreateOrUpdateProductOperationContract $operation
     * @return CreateOrUpdateProductResponseContract
     * @throws MissingProductLocalIdException|MissingProductRemoteIdException|CommerceExceptionContract|AdapterException|Exception
     */
    public function createOrUpdateProduct(CreateOrUpdateProductOperationContract $operation) : CreateOrUpdateProductResponseContract
    {
        $localId = $operation->getLocalId();

        if (! $localId) {
            throw new MissingProductLocalIdException('The product has no local ID.');
        }

        if ($remoteId = $this->productsMappingService->getRemoteId($operation->getProduct())) {
            return $this->updateProduct($operation, $remoteId);
        } else {
            return $this->createProduct($operation);
        }
    }

    /**
     * Updates the product in the remote service.
     *
     * @param CreateOrUpdateProductOperationContract $operation
     * @param string $remoteId
     * @return CreateOrUpdateProductResponseContract
     * @throws AdapterException|CommerceException|CommerceExceptionContract|MissingProductRemoteIdException|Exception
     */
    public function updateProduct(CreateOrUpdateProductOperationContract $operation, string $remoteId) : CreateOrUpdateProductResponseContract
    {
        $product = $this->productsProvider->products()->update($this->getUpdateProductInput($operation, $remoteId));

        if (! isset($product->productId) || ! $product->productId) {
            throw MissingProductRemoteIdException::withDefaultMessage();
        }

        return new CreateOrUpdateProductResponse($product->productId);
    }

    /**
     * Creates the product in the remote service.
     *
     * @param CreateOrUpdateProductOperationContract $operation
     * @return CreateOrUpdateProductResponseContract
     * @throws AdapterException|CommerceException|CommerceExceptionContract|MissingProductRemoteIdException|Exception
     */
    public function createProduct(CreateOrUpdateProductOperationContract $operation) : CreateOrUpdateProductResponseContract
    {
        $product = $this->productsProvider->products()->create($this->getCreateProductInput($operation));

        if (! isset($product->productId) || ! $product->productId) {
            throw MissingProductRemoteIdException::withDefaultMessage();
        }

        $this->productsMappingService->saveRemoteId($operation->getProduct(), $product->productId);

        return new CreateOrUpdateProductResponse($product->productId);
    }

    /**
     * Lists products.
     *
     * @param ListProductsOperationContract $operation
     *
     * @return ListProductsResponseContract
     */
    public function listProducts(ListProductsOperationContract $operation) : ListProductsResponseContract
    {
        return new ListProductsResponse($this->listProductsService->list($operation));
    }

    /**
     * Creates an instance of {@see UpdateProductInput} using the information from the product in the given operation.
     *
     * @param CreateOrUpdateProductOperationContract $operation
     * @param string $remoteId
     * @return UpdateProductInput
     * @throws AdapterException|CommerceException|Exception
     */
    protected function getUpdateProductInput(CreateOrUpdateProductOperationContract $operation, string $remoteId) : UpdateProductInput
    {
        $productData = $this->getProductData($operation->getProduct());

        if (! $productData) {
            throw new CommerceException('Unable to prepare product input data.');
        }

        $productData->productId = $remoteId;

        return new UpdateProductInput([
            'product' => $productData,
            'storeId' => $this->commerceContext->getStoreId(),
        ]);
    }

    /**
     * Creates an instance of {@see CreateProductInput} using the information from the product in the given operation.
     *
     * @param CreateOrUpdateProductOperationContract $operation
     * @return CreateProductInput
     * @throws AdapterException|CommerceException|Exception
     */
    protected function getCreateProductInput(CreateOrUpdateProductOperationContract $operation) : CreateProductInput
    {
        $productData = $this->getProductData($operation->getProduct());

        if (! $productData) {
            throw new CommerceException('Unable to prepare product input data.');
        }

        return new CreateProductInput([
            'product' => $productData,
            'storeId' => $this->commerceContext->getStoreId(),
        ]);
    }

    /**
     * Attempts to create a product data object for the given MWC Product.
     *
     * @param Product $product
     * @return ProductBase
     * @throws AdapterException|Exception|MissingProductRemoteIdForParentException
     */
    protected function getProductData(Product $product) : ?ProductBase
    {
        return ProductBaseAdapter::getNewInstance($this->productsMappingService)->convertToSource($product);
    }
}
