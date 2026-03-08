<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory;

use GoDaddy\WordPress\MWC\Common\Components\Contracts\ComponentContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\AbstractIntegration;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Interceptors\CheckoutOrderInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Interceptors\ProductDataStoreInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Interceptors\ProductVariationDataStoreInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Interceptors\StoreLocationInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Interceptors\VariableProductDataStoreInterceptor;

class InventoryIntegration extends AbstractIntegration
{
    public const NAME = 'inventory';

    /** @var class-string<ComponentContract>[] */
    protected array $componentClasses = [
        CheckoutOrderInterceptor::class,
        ProductDataStoreInterceptor::class,
        ProductVariationDataStoreInterceptor::class,
        VariableProductDataStoreInterceptor::class,
        StoreLocationInterceptor::class,
    ];

    /**
     * {@inheritDoc}
     */
    protected static function getIntegrationName() : string
    {
        return self::NAME;
    }
}
