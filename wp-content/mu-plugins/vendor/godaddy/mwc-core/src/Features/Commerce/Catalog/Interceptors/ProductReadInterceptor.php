<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors;

use Exception;
use GoDaddy\WordPress\MWC\Common\Interceptors\AbstractInterceptor;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\CatalogIntegration;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\Handlers\ProductReadHandler;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Traits\CanLoadWhenReadsEnabledTrait;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Commerce;

/**
 * Interceptor for reading product post objects from catalog.
 */
class ProductReadInterceptor extends AbstractInterceptor
{
    use CanLoadWhenReadsEnabledTrait;

    /**
     * Adds hooks.
     *
     * @return void
     * @throws Exception
     */
    public function addHooks() : void
    {
        /* @see wp_insert_post() */
        Register::action()
            ->setGroup('godaddy/wp_insert_post/before_get_post_instance') // @TODO confirm hook name {unfulvio 2023-04-25}
            ->setHandler([$this, 'disableReads'])
            ->setPriority(PHP_INT_MAX)
            ->execute();

        /* @see wp_insert_post() */
        Register::action()
            ->setGroup('godaddy/wp_insert_post/after_get_post_instance') // @TODO confirm hook name {unfulvio 2023-04-25}
            ->setHandler([$this, 'enableReads'])
            ->setPriority(PHP_INT_MAX)
            ->execute();

        /* @see \WP_Post::get_instance() */
        Register::filter()
            ->setGroup('godaddy/wp_post/get_instance') // @TODO confirm hook name {unfulvio 2023-04-25}
            ->setHandler([ProductReadHandler::class, 'handle'])
            ->setPriority(PHP_INT_MAX)
            ->execute();
    }

    /**
     * Enables reads from catalog.
     *
     * @return void
     */
    public function enableReads() : void
    {
        CatalogIntegration::enableCapability(Commerce::CAPABILITY_READ);
    }

    /**
     * Disables reads from catalog.
     *
     * @return void
     */
    public function disableReads() : void
    {
        CatalogIntegration::disableCapability(Commerce::CAPABILITY_READ);
    }
}
