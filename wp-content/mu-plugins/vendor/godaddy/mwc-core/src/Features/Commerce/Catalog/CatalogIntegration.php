<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\AbstractIntegration;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\CostOfGoodsInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\PrimePostCachesInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\ProductDataStoreInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\ProductEditInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\ProductReadInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\ProductVariationDataStoreInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\StockManagementSettingInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\UpdateProductMetaCacheInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\VariableProductDataStoreInterceptor;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\WpQueryInterceptor;

/**
 * Commerce Catalog integration class.
 */
class CatalogIntegration extends AbstractIntegration
{
    /** @var string the name of the integration */
    public const NAME = 'catalog';

    /** @var class-string[] alphabetically ordered list of components to load */
    protected array $componentClasses = [
        ProductReadInterceptor::class,
        UpdateProductMetaCacheInterceptor::class,
        StockManagementSettingInterceptor::class,
        ProductDataStoreInterceptor::class,
        ProductVariationDataStoreInterceptor::class,
        VariableProductDataStoreInterceptor::class,
        PrimePostCachesInterceptor::class,
        WpQueryInterceptor::class,
        CostOfGoodsInterceptor::class,
        ProductEditInterceptor::class,
    ];

    /**
     * {@inheritDoc}
     */
    protected static function getIntegrationName() : string
    {
        return self::NAME;
    }
}
