<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataSources\Adapters;

use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;
use GoDaddy\WordPress\MWC\Common\Traits\HasStringRemoteIdentifierTrait;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Contracts\HasStoreIdentifierContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\LineItem as LineItemDataObject;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Order as OrderDataObject;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\OrderContext;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataSources\Adapters\Factories\OrderContextAdapterFactory;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataSources\Contracts\DataObjectAdapterContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataSources\Adapters\DateTimeAdapter;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Traits\HasStoreIdentifierTrait;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Models\Orders\Order;

class OrderAdapter implements DataObjectAdapterContract, HasStoreIdentifierContract
{
    use HasStoreIdentifierTrait;
    use HasStringRemoteIdentifierTrait;

    protected OrderContextAdapterFactory $orderContextAdapterFactory;

    protected LineItemAdapter $lineItemAdapter;

    protected OrderStatusesAdapter $orderStatusesAdapter;

    protected OrderTotalsAdapter $orderTotalsAdapter;

    protected DateTimeAdapter $dateTimeAdapter;

    public function __construct(
        OrderContextAdapterFactory $orderContextAdapter,
        LineItemAdapter $lineItemAdapter,
        OrderStatusesAdapter $orderStatusesAdapter,
        OrderTotalsAdapter $orderTotalsAdapter,
        DateTimeAdapter $dateTimeAdapter
    ) {
        $this->orderContextAdapterFactory = $orderContextAdapter;
        $this->lineItemAdapter = $lineItemAdapter;
        $this->orderStatusesAdapter = $orderStatusesAdapter;
        $this->orderTotalsAdapter = $orderTotalsAdapter;
        $this->dateTimeAdapter = $dateTimeAdapter;
    }

    /**
     * {@inheritDoc}
     */
    public function convertFromSource($source)
    {
        // No-op
    }

    /**
     * {@inheritDoc}
     *
     * @param Order $target
     * @return OrderDataObject
     */
    public function convertToSource($target)
    {
        return new OrderDataObject([
            'id'          => $this->getOrderId(),
            'cartId'      => $this->getCartId($target),
            'context'     => $this->getContextFromOrder($target),
            'lineItems'   => $this->convertLineItemsToSource($target),
            'processedAt' => $this->getProcessedAtFromOrder($target),
            'statuses'    => $this->orderStatusesAdapter->convertToSource($target),
            'totals'      => $this->orderTotalsAdapter->convertToSource($target),
        ]);
    }

    protected function getContextFromOrder(Order $order) : OrderContext
    {
        $adapter = $this->orderContextAdapterFactory->getAdapterFromTarget($order)->setStoreId($this->getStoreId());

        return $adapter->convertToSource($order);
    }

    /**
     * Converts order's {@see LineItem} to Commerce's {@see LineItemDataObject}.
     *
     * @param Order $order
     * @return LineItemDataObject[]
     */
    protected function convertLineItemsToSource(Order $order) : array
    {
        return array_map(
            fn (LineItem $lineItem) => $this->lineItemAdapter->convertToSource($lineItem),
            $order->getLineItems()
        );
    }

    /**
     * Gets adapted processed at timestamp from given order.
     *
     * @param Order $order
     * @return non-empty-string
     */
    protected function getProcessedAtFromOrder(Order $order) : string
    {
        return $this->dateTimeAdapter->convertToSourceOrNow($order->getCreatedAt());
    }

    /**
     * @return non-empty-string|null
     */
    protected function getOrderId() : ?string
    {
        return $this->nonEmptyStringOrNull($this->getRemoteId());
    }

    /**
     * Returns the given value if it is a non-empty string or null otherwise.
     *
     * @param mixed $value
     * @return non-empty-string|null
     */
    protected function nonEmptyStringOrNull($value) : ?string
    {
        return TypeHelper::string($value, '') ?: null;
    }

    /**
     * Gets the Cart ID of the order model.
     *
     * @return non-empty-string|null
     */
    protected function getCartId(Order $order) : ?string
    {
        return $this->nonEmptyStringOrNull($order->getCartId());
    }
}
