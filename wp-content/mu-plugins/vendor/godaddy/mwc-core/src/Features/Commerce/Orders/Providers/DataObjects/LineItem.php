<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Enums\LineItemMode;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Enums\LineItemStatus;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Enums\LineItemType;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataObjects\AbstractDataObject;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataObjects\SimpleMoney;

class LineItem extends AbstractDataObject
{
    /** @var LineItemDetails|null All product snapshot-related information for a line item */
    public ?LineItemDetails $details = null;

    /** @var non-empty-string|null */
    public ?string $id = null;

    /** @var LineItemMode::* */
    public string $fulfillmentMode;

    public string $name;
    public float $quantity = 1;

    /** @var LineItemStatus::* */
    public string $status;

    /** @var LineItemType::* */
    public string $type;

    public SimpleMoney $unitAmount;

    /**
     * Constructor.
     *
     * @param array{
     *     details?: ?LineItemDetails,
     *     id?: ?non-empty-string,
     *     fulfillmentMode: LineItemMode::*,
     *     name: string,
     *     quantity: float,
     *     status: LineItemStatus::*,
     *     type: LineItemType::*,
     *     unitAmount: SimpleMoney
     * } $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
