<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services;

use Exception;
use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Note;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Contracts\ReservationsServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Operations\CreateOrUpdateReservationOperation;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataSources\WooOrderCartIdProvider;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services\Contracts\OrderReservationsServiceContract;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Models\Orders\Order;
use WC_Order;

class OrderReservationsService implements OrderReservationsServiceContract
{
    const TRANSIENT_RESERVATIONS_FAILED = 'godaddy_mwc_commerce_reservations_failed';

    protected ReservationsServiceContract $reservationsService;
    protected WooOrderCartIdProvider $cartIdProvider;

    /**
     * @param ReservationsServiceContract $reservationsService
     * @param WooOrderCartIdProvider $cartIdProvider
     */
    public function __construct(
        ReservationsServiceContract $reservationsService,
        WooOrderCartIdProvider $cartIdProvider
    ) {
        $this->reservationsService = $reservationsService;
        $this->cartIdProvider = $cartIdProvider;
    }

    /**
     * {@inheritDoc}
     *
     * @throws BaseException
     */
    public function createOrUpdateReservations(Order &$order) : void
    {
        $existingNotes = $order->getNotes();
        $newNotes = [];

        foreach ($order->getLineItems() as $lineItem) {
            try {
                $this->reservationsService->createOrUpdateReservation(new CreateOrUpdateReservationOperation($lineItem, $order));
            } catch (Exception $exception) {
                $this->markOrderReservationsFailed($order);

                $newNotes[] = Note::seed([
                    'authorName' => Note::SYSTEM_AUTHOR_NAME,
                    'content'    => sprintf(
                        /* translators: Placeholders: %1$s - a product name, %2$s - a product SKU, %3$s - an API error message */
                        __('An error occurred while reserving stock for %1$s (%2$s). %3$s', 'mwc-core'),
                        $lineItem->getName(),
                        $lineItem->getSku(),
                        $exception->getMessage()
                    ),
                ]);
            }
        }

        /** @var Note[] $notes */
        $notes = ArrayHelper::combine($existingNotes, $newNotes);

        $order->setNotes($notes);
    }

    /**
     * Marks an order as having failed reservations.
     *
     * @param Order $order
     */
    public function markOrderReservationsFailed(Order $order) : void
    {
        set_transient(static::TRANSIENT_RESERVATIONS_FAILED.$order->getCartId(), 'yes', 10);
    }

    /**
     * Determines if an order has failed reservations.
     *
     * @param WC_Order $order
     *
     * @return bool
     */
    public function orderHasFailedReservations(WC_Order $order) : bool
    {
        return wc_string_to_bool(TypeHelper::string(get_transient(static::TRANSIENT_RESERVATIONS_FAILED.$this->cartIdProvider->getCartId($order)), ''));
    }
}
