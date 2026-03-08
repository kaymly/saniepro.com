<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataObjects\AbstractDataObject;

/**
 * Maintains an association between a local WooCommerce product ID and a remote {@see ProductBase} object.
 *
 * @method static static getNewInstance(array $data)
 */
class ProductAssociation extends AbstractDataObject
{
    /** @var ProductBase remote product from the platform */
    public ProductBase $product;

    /** @var int ID of the local WooCommerce product that corresponds to the above remote entity */
    public int $localId;

    /**
     * Constructor.
     *
     * @param array{
     *     product: ProductBase,
     *     localId: int,
     * } $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
