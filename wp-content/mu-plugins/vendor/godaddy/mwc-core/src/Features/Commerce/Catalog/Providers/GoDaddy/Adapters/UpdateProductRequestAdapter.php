<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\GoDaddy\Adapters;

use GoDaddy\WordPress\MWC\Common\Http\Contracts\RequestContract;
use GoDaddy\WordPress\MWC\Common\Http\Contracts\ResponseContract;
use GoDaddy\WordPress\MWC\Common\Traits\CanGetNewInstanceTrait;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductBase;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductRequestInputs\UpdateProductInput;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\GoDaddy\Http\Requests\Request;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\CommerceException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\Adapters\AbstractGatewayRequestAdapter;

/**
 * Product update request adapter.
 *
 * @method static static getNewInstance(UpdateProductInput $input)
 */
class UpdateProductRequestAdapter extends AbstractGatewayRequestAdapter
{
    use CanGetNewInstanceTrait;

    /** @var UpdateProductInput data used to create the request */
    protected UpdateProductInput $input;

    /**
     * Constructor.
     *
     * @param UpdateProductInput $input
     */
    public function __construct(UpdateProductInput $input)
    {
        $this->input = $input;
    }

    /**
     * {@inheritDoc}
     */
    public function convertFromSource() : RequestContract
    {
        if (! isset($this->input->product->productId) || empty($this->input->product->productId)) {
            throw new CommerceException('A product ID is required to build an update product request.');
        }

        $body = $this->input->product->toArray();

        // We do not need the productId, channelIds, or categoryIds in the request body:
        // the productId is only needed to build the API path; the channelIds are only required when creating products;
        // we do not yet utilize categoryIds and do not want to overwrite values other channels may have set.
        // The API does not support updates using the parentId parameter.
        unset($body['productId'], $body['channelIds'], $body['categoryIds'], $body['parentId']);

        return Request::withAuth()
            ->setStoreId($this->input->storeId)
            ->setBody($body)
            ->setPath("/products/{$this->input->product->productId}")
            ->setMethod('patch');
    }

    /**
     * Converts gateway response to source.
     *
     * @param ResponseContract $response
     * @return ProductBase
     */
    protected function convertResponse(ResponseContract $response) : ProductBase
    {
        return $this->input->product;
    }
}
