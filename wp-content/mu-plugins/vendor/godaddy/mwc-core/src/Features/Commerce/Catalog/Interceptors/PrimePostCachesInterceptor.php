<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors;

use Exception;
use GoDaddy\WordPress\MWC\Common\Interceptors\AbstractInterceptor;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\Handlers\PrimePostCachesHandler;

/**
 * Interceptor for priming product post caches.
 */
class PrimePostCachesInterceptor extends AbstractInterceptor
{
    /**
     * Adds hooks.
     *
     * @return void
     * @throws Exception
     */
    public function addHooks() : void
    {
        /* @see _prime_post_caches() */
        Register::filter()
            ->setGroup('godaddy/prime_post_caches/posts')
            ->setHandler([PrimePostCachesHandler::class, 'handle'])
            ->setArgumentsCount(2)
            ->execute();
    }
}
