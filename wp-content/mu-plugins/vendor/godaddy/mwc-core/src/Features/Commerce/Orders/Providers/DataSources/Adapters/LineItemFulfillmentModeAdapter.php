<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataSources\Adapters;

use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Enums\LineItemMode;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataSources\Contracts\DataObjectAdapterContract;

class LineItemFulfillmentModeAdapter implements DataObjectAdapterContract
{
    /**
     * Converts a Commerce's line item fulfillment mode into order property values.
     *
     * @param LineItemMode::* $source
     * @return array{
     *     isVirtual: bool,
     *     isDownloadable: bool
     * }
     */
    public function convertFromSource($source) : array
    {
        return [
            'isVirtual' => in_array($source, [
                LineItemMode::Digital,
                LineItemMode::GiftCard,
                LineItemMode::Purchase,
                LineItemMode::QuickStay,
                LineItemMode::RegularStay,
            ]),
            'isDownloadable' => in_array($source, [
                LineItemMode::Digital,
                LineItemMode::GiftCard,
            ]),
        ];
    }

    /**
     * Converts a line item into a Commerce's line item fulfillment mode.
     *
     * @param LineItem $target
     * @return LineItemMode::*
     */
    public function convertToSource($target) : string
    {
        if ($target->getIsDownloadable()) {
            return LineItemMode::Digital;
        }

        if ($target->getIsVirtual()) {
            return LineItemMode::Purchase;
        }

        return LineItemMode::Ship;
    }
}
