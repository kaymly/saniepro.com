<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Locations;

use GoDaddy\WordPress\MWC\Common\Components\Contracts\ComponentContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\AbstractIntegration;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Locations\Interceptors\LocalPickupAdminInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Locations\Interceptors\LocalPickupCustomerInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Locations\Interceptors\LocalPickupEmailsInterceptor;

final class LocationsIntegration extends AbstractIntegration
{
    public const NAME = 'locations';

    /** @var class-string<ComponentContract>[] */
    protected array $componentClasses = [
        LocalPickupAdminInterceptor::class,
        LocalPickupCustomerInterceptor::class,
        LocalPickupEmailsInterceptor::class,
    ];

    /**
     * {@inheritDoc}
     */
    protected static function getIntegrationName() : string
    {
        return self::NAME;
    }
}
