<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors;

use Exception;
use GoDaddy\WordPress\MWC\Common\Content\Context\Screen;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Interceptors\AbstractInterceptor;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPressRepository;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Traits\CanLoadWhenReadsEnabledTrait;

/**
 * Interceptor for manipulating the product-editing experience.
 */
class ProductEditInterceptor extends AbstractInterceptor
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
        Register::action()
            ->setGroup('current_screen')
            ->setHandler([$this, 'deleteProductPostCacheOnAdminEditProduct'])
            ->setPriority(PHP_INT_MAX)
            ->execute();
    }

    /**
     * Deletes the post cache for a single product while loading the product edit screen in the admin.
     *
     * @return void
     */
    public function deleteProductPostCacheOnAdminEditProduct() : void
    {
        $currentScreen = WordPressRepository::getCurrentScreen();
        $postId = TypeHelper::int(ArrayHelper::get($_GET, 'post'), 0);

        if ($currentScreen instanceof Screen && 'product' === $currentScreen->getObjectType() && 0 !== $postId) {
            wp_cache_delete($postId, 'posts');
        }
    }
}
