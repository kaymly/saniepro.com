<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\WooCommerce;

use GoDaddy\WordPress\MWC\Common\Exceptions\AdapterException;
use GoDaddy\WordPress\MWC\Common\Exceptions\SentryException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Commerce;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Contracts\CanGenerateIdContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\Contracts\CommerceExceptionContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\OrdersIntegration;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataSources\WooOrderCartIdProvider;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services\Contracts\OrderReservationsServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services\Contracts\OrdersServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services\Operations\CreateOrderOperation;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Adapters\OrderAdapter;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Models\Orders\Order;
use WC_Order;
use WC_Order_Data_Store_CPT;

class OrderDataStore extends WC_Order_Data_Store_CPT
{
    protected OrdersServiceContract $ordersService;

    protected OrderReservationsServiceContract $orderReservationsService;

    protected WooOrderCartIdProvider $wooOrderCartIdProvider;

    protected CanGenerateIdContract $idProvider;

    public function __construct(
        OrdersServiceContract $ordersService,
        OrderReservationsServiceContract $orderReservationsService,
        WooOrderCartIdProvider $wooOrderCartIdProvider,
        CanGenerateIdContract $idProvider
    ) {
        $this->ordersService = $ordersService;
        $this->orderReservationsService = $orderReservationsService;
        $this->wooOrderCartIdProvider = $wooOrderCartIdProvider;
        $this->idProvider = $idProvider;
    }

    /**
     * Creates an order in the Commerce platform and WooCommerce's database.
     *
     * @param mixed $order
     */
    public function create(&$order) : void
    {
        if ($this->shouldCreateWooCommerceOrderInPlatform($order)) {
            $this->createWooCommerceOrderInPlatform($order);
        } else {
            parent::create($order);
        }
    }

    /**
     * Determines whether we should use the given input to create a WooCommerce order in the Commerce platform.
     *
     * @param mixed $wooOrder
     * @return bool
     * @phpstan-assert-if-true WC_Order $wooOrder
     */
    protected function shouldCreateWooCommerceOrderInPlatform($wooOrder) : bool
    {
        return $wooOrder instanceof WC_Order && OrdersIntegration::hasCommerceCapability(Commerce::CAPABILITY_WRITE);
    }

    /**
     * Creates an order in the Commerce platform and WooCommerce's database.
     */
    protected function createWooCommerceOrderInPlatform(WC_Order &$wooOrder) : void
    {
        if ($order = $this->convertOrderForPlatform($wooOrder)) {
            $this->tryToCreateOrderInPlatform($order);
        }

        parent::create($wooOrder);

        if ($order) {
            // TODO: set local IDs of all order items as well -- {wvega 2022-04-28}
            $this->processCreatedOrder($order->setId($wooOrder->get_id()));
        }
    }

    /**
     * Tries to create an order in the Commerce platform.
     */
    protected function tryToCreateOrderInPlatform(Order $order) : void
    {
        try {
            $this->createOrderInPlatform($order);
        } catch (CommerceExceptionContract $exception) {
            SentryException::getNewInstance(
                'An error occurred trying to create a remote record for an order.',
                $exception
            );
        }
    }

    /**
     * Creates an order in the Commerce platform.
     *
     * @throws CommerceExceptionContract
     */
    protected function createOrderInPlatform(Order $order) : void
    {
        $this->orderReservationsService->createOrUpdateReservations($order);
        $this->ordersService->createOrder(CreateOrderOperation::fromOrder($order));
    }

    /**
     * Converts a WooCommerce order into an instance of the {@see Order} model.
     */
    protected function convertOrderForPlatform(WC_Order $wooOrder) : ?Order
    {
        $wooOrder = $this->generateCartIdIfNotSet($wooOrder);

        try {
            return OrderAdapter::getNewInstance($wooOrder)->convertFromSource();
        } catch (AdapterException $exception) {
            SentryException::getNewInstance('An error occurred trying to convert the WooCommerce order into an Order instance.', $exception);
        }

        return null;
    }

    /**
     * Generates a cartId for the given WooCommerce order if one is not already set.
     *
     * @param WC_Order $wooOrder
     * @return WC_Order
     */
    protected function generateCartIdIfNotSet(WC_Order $wooOrder) : WC_Order
    {
        if (! $this->wooOrderCartIdProvider->getCartId($wooOrder)) {
            $this->wooOrderCartIdProvider->setCartId($wooOrder, $this->idProvider->generateId());
        }

        return $wooOrder;
    }

    /**
     * Runs order operations that must be executed after the local order is created.
     *
     * This method assumes that the given order has local IDs for all items that support a local ID.
     */
    protected function processCreatedOrder(Order $order) : void
    {
        // TODO: persist order and order items remote IDs -- {wvega 2022-04-28}
    }
}
