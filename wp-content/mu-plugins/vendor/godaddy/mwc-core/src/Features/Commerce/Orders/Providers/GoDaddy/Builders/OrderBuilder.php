<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\GoDaddy\Builders;

use GoDaddy\WordPress\MWC\Common\Builders\Contracts\BuilderContract;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Traits\CanGetNewInstanceTrait;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Enums\FulfillmentStatus;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Enums\LineItemMode;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Enums\LineItemStatus;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Enums\LineItemType;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Enums\PaymentStatus;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Enums\Status;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\LineItem;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\LineItemDetails;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Order;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\OrderContext;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\OrderStatuses;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\OrderTotals;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataObjects\SimpleMoney;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataSources\Adapters\DateTimeAdapter;

class OrderBuilder implements BuilderContract
{
    use CanGetNewInstanceTrait;

    /** @var array<string, mixed> */
    protected array $data = [];

    /**
     * Sets the order data.
     *
     * @param array<string, mixed> $value
     * @return $this
     */
    public function setData(array $value)
    {
        $this->data = $value;

        return $this;
    }

    /**
     * Creates a new Order data object using the current data ({@see OrderBuilder::setData()}) as source.
     *
     * @return Order
     */
    public function build() : Order
    {
        return new Order([
            'id'          => $this->getOrderId(),
            'cartId'      => $this->getCartId(),
            'context'     => $this->buildOrderContext(TypeHelper::array(ArrayHelper::get($this->data, 'context'), [])),
            'lineItems'   => $this->buildLineItems(TypeHelper::array(ArrayHelper::get($this->data, 'lineItems'), [])),
            'processedAt' => $this->buildDateTimeStringOrNow(ArrayHelper::get($this->data, 'processedAt')),
            'statuses'    => $this->buildOrderStatuses(TypeHelper::array(ArrayHelper::get($this->data, 'statuses'), [])),
            'totals'      => $this->buildOrderTotals(TypeHelper::array(ArrayHelper::get($this->data, 'totals'), [])),
        ]);
    }

    /**
     * Gets order ID from data.
     *
     * @return non-empty-string|null
     */
    protected function getOrderId() : ?string
    {
        return $this->nonEmptyStringOrNull(ArrayHelper::get($this->data, 'id'));
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
     * Gets the order Cart ID from data.
     *
     * @return non-empty-string|null
     */
    protected function getCartId() : ?string
    {
        return $this->nonEmptyStringOrNull(ArrayHelper::get($this->data, 'cartId'));
    }

    /**
     * Builds an {@see OrderContext} object using the given data.
     *
     * @param array<string, mixed> $data
     * @return OrderContext
     */
    protected function buildOrderContext(array $data) : OrderContext
    {
        return new OrderContext([
            'channelId' => TypeHelper::string(ArrayHelper::get($data, 'channelId'), ''),
            'owner'     => TypeHelper::string(ArrayHelper::get($data, 'owner'), ''),
            'storeId'   => TypeHelper::string(ArrayHelper::get($data, 'storeId'), ''),
        ]);
    }

    /**
     * Builds an array of {@see LineItem} objects using the given data.
     *
     * @param mixed[] $data
     * @return LineItem[]
     */
    protected function buildLineItems(array $data) : array
    {
        return array_values(array_map(
            fn ($lineItemData) => $this->buildLineItem(TypeHelper::array($lineItemData, [])),
            $data
        ));
    }

    /**
     * Builds a {@see LineItem} object using the given data.
     *
     * @param array<string, mixed> $data
     * @return LineItem
     */
    protected function buildLineItem(array $data) : LineItem
    {
        return new LineItem([
            'fulfillmentMode' => LineItemMode::tryFrom(TypeHelper::string(ArrayHelper::get($data, 'fulfillmentMode'), '')) ?? LineItemMode::None,
            'id'              => $this->nonEmptyStringOrNull(TypeHelper::string(ArrayHelper::get($data, 'id'), '')),
            'name'            => TypeHelper::string(ArrayHelper::get($data, 'name'), ''),
            'quantity'        => TypeHelper::float(ArrayHelper::get($data, 'quantity'), 1),
            'status'          => LineItemStatus::tryFrom(TypeHelper::string(ArrayHelper::get($data, 'status'), '')) ?? LineItemStatus::Unfulfilled,
            'type'            => LineItemType::tryFrom(TypeHelper::string(ArrayHelper::get($data, 'type'), '')) ?? LineItemType::Physical,
            'unitAmount'      => $this->buildSimpleMoney(TypeHelper::array(ArrayHelper::get($data, 'unitAmount'), [])),
            'details'         => $this->buildLineItemDetails(TypeHelper::array(ArrayHelper::get($data, 'details'), [])),
        ]);
    }

    /**
     * Builds a {@see LineItemDetails} object from the given data.
     *
     * @param array<string, mixed> $data
     * @return LineItemDetails|null
     */
    protected function buildLineItemDetails(array $data) : ?LineItemDetails
    {
        if (empty($data)) {
            return null;
        }

        $properties = [];

        foreach (['sku', 'productAssetUrl', 'unitOfMeasure'] as $propertyName) {
            if ($value = TypeHelper::string(ArrayHelper::get($data, $propertyName), '')) {
                $properties[$propertyName] = $value;
            }
        }

        return new LineItemDetails($properties);
    }

    /**
     * Returns the given value if it is a non-empty string or the current date time otherwise.
     *
     * @param mixed $value
     * @return non-empty-string
     */
    protected function buildDateTimeStringOrNow($value) : string
    {
        return $this->buildDateTimeString($value) ?? (new DateTimeAdapter())->convertToSourceOrNow(null);
    }

    /**
     * Returns the given value if it is a non-empty string or null.
     *
     * @param mixed $value
     * @return non-empty-string|null
     */
    protected function buildDateTimeString($value) : ?string
    {
        return TypeHelper::string($value, '') ?: null;
    }

    /**
     * Builds a {@see SimpleMoney} object using the given data.
     *
     * @param array<string, mixed> $data
     * @return SimpleMoney
     */
    protected function buildSimpleMoney(array $data) : SimpleMoney
    {
        return new SimpleMoney([
            'currencyCode' => TypeHelper::string(ArrayHelper::get($data, 'currencyCode'), ''),
            'value'        => TypeHelper::int(ArrayHelper::get($data, 'value'), 0),
        ]);
    }

    /**
     * Builds a {@see OrderStatuses} object using the given data.
     *
     * @param array<string, mixed> $data
     * @return OrderStatuses
     */
    protected function buildOrderStatuses(array $data) : OrderStatuses
    {
        return new OrderStatuses([
            'fulfillmentStatus' => FulfillmentStatus::tryFrom(TypeHelper::string(ArrayHelper::get($data, 'fulfillmentStatus'), '')) ?? FulfillmentStatus::Unfulfilled,
            'paymentStatus'     => PaymentStatus::tryFrom(TypeHelper::string(ArrayHelper::get($data, 'paymentStatus'), '')) ?? PaymentStatus::None,
            'status'            => Status::tryFrom(TypeHelper::string(ArrayHelper::get($data, 'status'), '')) ?? Status::Open,
        ]);
    }

    /**
     * Builds a {@see OrderTotals} object using the given data.
     *
     * @param array<string, mixed> $data
     * @return OrderTotals
     */
    protected function buildOrderTotals(array $data) : OrderTotals
    {
        return new OrderTotals([
            'discountTotal' => $this->buildSimpleMoney(TypeHelper::array(ArrayHelper::get($data, 'discountTotal'), [])),
            'feeTotal'      => $this->buildSimpleMoney(TypeHelper::array(ArrayHelper::get($data, 'feeTotal'), [])),
            'shippingTotal' => $this->buildSimpleMoney(TypeHelper::array(ArrayHelper::get($data, 'shippingTotal'), [])),
            'subTotal'      => $this->buildSimpleMoney(TypeHelper::array(ArrayHelper::get($data, 'subTotal'), [])),
            'taxTotal'      => $this->buildSimpleMoney(TypeHelper::array(ArrayHelper::get($data, 'taxTotal'), [])),
            'total'         => $this->buildSimpleMoney(TypeHelper::array(ArrayHelper::get($data, 'total'), [])),
        ]);
    }
}
