<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Notices;

use GoDaddy\WordPress\MWC\Common\Traits\CanGetNewInstanceTrait;
use GoDaddy\WordPress\MWC\Core\Admin\Notices\Notice;

class ProductInventoryUpdateFailedNotice extends Notice
{
    use CanGetNewInstanceTrait;

    /** {@inheritdoc} */
    protected $type = self::TYPE_ERROR;

    /** {@inheritdoc} */
    protected $id = 'mwc-commerce-product-inventory-update-failed';

    /**
     * ProductInventoryUpdateFailedNotice constructor.
     */
    public function __construct()
    {
        $this->setContent(__('Notice content TBD'));
    }
}
