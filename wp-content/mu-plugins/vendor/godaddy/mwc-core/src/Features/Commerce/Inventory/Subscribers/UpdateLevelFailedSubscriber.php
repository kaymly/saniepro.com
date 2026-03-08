<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Subscribers;

use GoDaddy\WordPress\MWC\Core\Admin\Notices\Notice;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Notices\ProductInventoryUpdateFailedNotice;

class UpdateLevelFailedSubscriber extends AbstractFailHandlerSubscriber
{
    /**
     * Gets the notice for the subscriber.
     *
     * @return Notice
     */
    public function getNotice() : Notice
    {
        return ProductInventoryUpdateFailedNotice::getNewInstance();
    }
}
