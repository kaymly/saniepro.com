<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Contracts;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Operations\Contracts\CreateOrUpdateReservationOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Operations\Contracts\ReadReservationOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Responses\Contracts\CreateOrUpdateReservationResponseContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Responses\Contracts\ReadReservationResponseContract;

interface ReservationsServiceContract
{
    /**
     * Create or update a reservation.
     *
     * @param CreateOrUpdateReservationOperationContract $operation
     * @return CreateOrUpdateReservationResponseContract
     */
    public function createOrUpdateReservation(CreateOrUpdateReservationOperationContract $operation) : CreateOrUpdateReservationResponseContract;

    /**
     * Read a reservation.
     *
     * @param ReadReservationOperationContract $operation
     * @return ReadReservationResponseContract
     */
    public function readReservation(ReadReservationOperationContract $operation) : ReadReservationResponseContract;
}
