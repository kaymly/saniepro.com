<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductBase;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Services\Contracts\CachingServiceContract;

/**
 * Contract for services to handle caching remote {@see ProductBase} objects.
 */
interface ProductsCachingServiceContract extends CachingServiceContract
{
}
