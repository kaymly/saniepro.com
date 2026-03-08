<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services\Contracts;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\Contracts\CommerceExceptionContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services\Operations\Contracts\CreateOrderOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services\Responses\Contracts\CreateOrderResponseContract;

interface OrdersServiceContract
{
    /**
     * Creates an order using the provided operation.
     *
     * @param CreateOrderOperationContract $operation
     * @return CreateOrderResponseContract
     * @throws CommerceExceptionContract
     */
    public function createOrder(CreateOrderOperationContract $operation) : CreateOrderResponseContract;
}
