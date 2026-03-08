<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataObjects\AbstractDataObject;

class Order extends AbstractDataObject
{
    /** @var non-empty-string|null */
    public ?string $id = null;

    /** @var non-empty-string|null */
    public ?string $cartId = null;

    public OrderContext $context;

    /** @var LineItem[] */
    public array $lineItems;

    /** @var Note[] */
    public array $notes = [];

    /** @var non-empty-string */
    public string $processedAt;

    public OrderStatuses $statuses;

    public OrderTotals $totals;

    /**
     * Constructor.
     *
     * @param array{
     *     id?: ?non-empty-string,
     *     cartId?: ?non-empty-string,
     *     context: OrderContext,
     *     lineItems: LineItem[],
     *     notes?: Note[],
     *     processedAt: non-empty-string,
     *     statuses: OrderStatuses,
     *     totals: OrderTotals
     * } $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
