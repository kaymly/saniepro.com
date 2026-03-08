<?php

namespace GoDaddy\WordPress\MWC\Core\Providers\Commerce\Catalog;

use GoDaddy\WordPress\MWC\Common\Container\Providers\AbstractServiceProvider;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ListProductsCachingServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\ListProductsCachingService;

/**
 * Service provider for the List Products Caching Service.
 */
class ListProductsCachingServiceServiceProvider extends AbstractServiceProvider
{
    protected array $provides = [ListProductsCachingServiceContract::class];

    /**
     * {@inheritDoc}
     */
    public function register() : void
    {
        $this->getContainer()->bind(ListProductsCachingServiceContract::class, ListProductsCachingService::class);
    }
}
