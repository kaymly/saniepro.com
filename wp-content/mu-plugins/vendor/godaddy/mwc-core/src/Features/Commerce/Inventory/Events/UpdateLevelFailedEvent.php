<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Events;

use GoDaddy\WordPress\MWC\Common\Models\Products\Product;

class UpdateLevelFailedEvent extends AbstractInventoryServiceFailEvent
{
    /** @var Product */
    public Product $product;

    /**
     * Event constructor.
     *
     * @param Product $product
     * @param string $failReason
     */
    public function __construct(Product $product, string $failReason)
    {
        $this->product = $product;
        $this->failReason = $failReason;
    }
}
