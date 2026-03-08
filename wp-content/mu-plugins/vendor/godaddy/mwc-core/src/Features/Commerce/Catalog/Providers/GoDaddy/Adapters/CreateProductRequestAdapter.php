<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\GoDaddy\Adapters;

use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Http\Contracts\RequestContract;
use GoDaddy\WordPress\MWC\Common\Http\Contracts\ResponseContract;
use GoDaddy\WordPress\MWC\Common\Traits\CanGetNewInstanceTrait;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductBase;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductRequestInputs\CreateProductInput;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\GoDaddy\Http\Requests\Request;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\MissingProductRemoteIdException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\Adapters\AbstractGatewayRequestAdapter;

/**
 * Product creation request adapter.
 *
 * @method static static getNewInstance(CreateProductInput $input)
 */
class CreateProductRequestAdapter extends AbstractGatewayRequestAdapter
{
    use CanGetNewInstanceTrait;

    /** @var CreateProductInput data used to build the request */
    protected CreateProductInput $input;

    /**
     * Constructor.
     *
     * @param CreateProductInput $input
     */
    public function __construct(CreateProductInput $input)
    {
        $this->input = $input;
    }

    /**
     * {@inheritDoc}
     */
    public function convertFromSource() : RequestContract
    {
        $body = $this->input->product->toArray();

        // we should not have a remote productId value when _creating_ a product
        unset($body['productId']);

        // null sale prices aren't allowed, they need to be fully omitted
        if (empty($body['salePrice'])) {
            unset($body['salePrice']);
        }

        return Request::withAuth()
            ->setStoreId($this->input->storeId)
            ->setBody($body)
            ->setPath('/products')
            ->setMethod('post');
    }

    /**
     * Converts gateway response to source.
     *
     * @param ResponseContract $response
     * @return ProductBase
     * @throws MissingProductRemoteIdException
     */
    public function convertResponse(ResponseContract $response) : ProductBase
    {
        $productId = TypeHelper::string(ArrayHelper::get((array) $response->getBody(), 'product.productId'), '');

        if (empty($productId)) {
            throw new MissingProductRemoteIdException('The product ID was not returned from the response.');
        }

        $this->input->product->productId = $productId;

        return $this->input->product;
    }
}
