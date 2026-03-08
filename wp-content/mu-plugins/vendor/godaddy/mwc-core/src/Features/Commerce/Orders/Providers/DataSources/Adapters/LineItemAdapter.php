<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataSources\Adapters;

use GoDaddy\WordPress\MWC\Common\Models\CurrencyAmount;
use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\LineItem as LineItemDataObject;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\LineItemDetails;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataSources\Contracts\DataObjectAdapterContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataObjects\SimpleMoney;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataSources\Adapters\SimpleMoneyAdapter;

/**
 * Converts a Commerce line item data object into a native line item.
 */
class LineItemAdapter implements DataObjectAdapterContract
{
    protected LineItemFulfillmentModeAdapter $lineItemFulfillmentModeAdapter;

    protected LineItemFulfillmentStatusAdapter $lineItemFulfillmentStatusAdapter;

    protected LineItemTypeAdapter $lineItemTypeAdapter;

    protected SimpleMoneyAdapter $simpleMoneyAdapter;

    protected LineItemDetailsAdapter $lineItemDetailsAdapter;

    /**
     * Constructor.
     *
     * @param LineItemFulfillmentModeAdapter $lineItemFulfillmentModeAdapter
     * @param LineItemFulfillmentStatusAdapter $lineItemFulfillmentStatusAdapter
     * @param LineItemTypeAdapter $lineItemTypeAdapter
     * @param SimpleMoneyAdapter $simpleMoneyAdapter
     * @param LineItemDetailsAdapter $lineItemDetailsAdapter
     */
    public function __construct(
        LineItemFulfillmentModeAdapter $lineItemFulfillmentModeAdapter,
        LineItemFulfillmentStatusAdapter $lineItemFulfillmentStatusAdapter,
        LineItemTypeAdapter $lineItemTypeAdapter,
        SimpleMoneyAdapter $simpleMoneyAdapter,
        LineItemDetailsAdapter $lineItemDetailsAdapter
    ) {
        $this->lineItemFulfillmentModeAdapter = $lineItemFulfillmentModeAdapter;
        $this->lineItemFulfillmentStatusAdapter = $lineItemFulfillmentStatusAdapter;
        $this->lineItemTypeAdapter = $lineItemTypeAdapter;
        $this->simpleMoneyAdapter = $simpleMoneyAdapter;
        $this->lineItemDetailsAdapter = $lineItemDetailsAdapter;
    }

    /**
     * Converts a Commerce line item data object into a native line item.
     *
     * @param LineItemDataObject $source
     */
    public function convertFromSource($source) : LineItem
    {
        $lineItem = $this->mapFulfillmentModeFromSource($source, new LineItem());

        return $this->mapLineItemDetailsFromSource($source, $lineItem)
            ->setName($source->name)
            ->setQuantity($source->quantity)
            ->setFulfillmentStatus($this->lineItemFulfillmentStatusAdapter->convertFromSource($source->status))
            ->setSubTotalAmount($this->getSubTotalAmountFromSource($source));
    }

    /**
     * Maps line item details from source {@see LineItemDetails}.
     *
     * @param LineItemDataObject $source
     * @param LineItem $lineItem
     * @return LineItem
     */
    protected function mapLineItemDetailsFromSource(LineItemDataObject $source, LineItem $lineItem) : LineItem
    {
        return $this->lineItemDetailsAdapter->convertFromSource($source->details, $lineItem);
    }

    /**
     * Maps fulfillment mode from source into the native {@see LineItem} model.
     *
     * @param LineItemDataObject $source
     * @param LineItem $lineItem
     * @return LineItem
     */
    protected function mapFulfillmentModeFromSource(LineItemDataObject $source, LineItem $lineItem) : LineItem
    {
        $properties = $this->lineItemFulfillmentModeAdapter->convertFromSource($source->fulfillmentMode);

        $lineItem->setIsVirtual($properties['isVirtual']);
        $lineItem->setIsDownloadable($properties['isDownloadable']);

        return $lineItem;
    }

    /**
     * Gets subtotal amount from source as native {@see CurrencyAmount} model.
     *
     * @param LineItemDataObject $source
     * @return CurrencyAmount
     */
    protected function getSubTotalAmountFromSource(LineItemDataObject $source) : CurrencyAmount
    {
        $subTotal = $this->simpleMoneyAdapter->convertFromSimpleMoney($source->unitAmount);

        $subTotal->setAmount((int) ($subTotal->getAmount() * $source->quantity));

        return $subTotal;
    }

    /**
     * Converts a native line item into a Commerce line item data object.
     *
     * @param LineItem $target
     *
     * @return LineItemDataObject
     */
    public function convertToSource($target) : LineItemDataObject
    {
        return new LineItemDataObject([
            'fulfillmentMode' => $this->lineItemFulfillmentModeAdapter->convertToSource($target),
            'name'            => $target->getName(),
            'quantity'        => $target->getQuantity(),
            'status'          => $this->lineItemFulfillmentStatusAdapter->convertToSource($target),
            'type'            => $this->lineItemTypeAdapter->convertToSource($target),
            'unitAmount'      => $this->getLineItemUnitAmount($target),
            'details'         => $this->getLineItemDetails($target),
        ]);
    }

    /**
     * Gets an instance {@see LineItemDetails} data object from the native {@see LineItem} model.
     *
     * @param LineItem $lineItem
     * @return LineItemDetails
     */
    protected function getLineItemDetails(LineItem $lineItem) : LineItemDetails
    {
        return $this->lineItemDetailsAdapter->convertToSource($lineItem);
    }

    /**
     * Gets an instance of {@see SimpleMoney} data object from the native {@see LineItem} model.
     *
     * @param LineItem $lineItem
     * @return SimpleMoney
     */
    protected function getLineItemUnitAmount(LineItem $lineItem) : SimpleMoney
    {
        $subTotal = $lineItem->getSubTotalAmount();

        return new SimpleMoney([
            'currencyCode' => $subTotal->getCurrencyCode(),
            'value'        => $lineItem->getQuantity() > 0 ? (int) ($subTotal->getAmount() / $lineItem->getQuantity()) : 0,
        ]);
    }
}
