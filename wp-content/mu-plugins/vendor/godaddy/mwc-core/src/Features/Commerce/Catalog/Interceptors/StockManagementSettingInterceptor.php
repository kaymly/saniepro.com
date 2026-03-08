<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors;

use Exception;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Interceptors\AbstractInterceptor;
use GoDaddy\WordPress\MWC\Common\Register\Register;

/**
 * Intercepts the "Manage Stock?" global setting in Settings > Products > Inventory to ensure it's always enabled.
 * This can still be modified on a per-product basis.
 */
class StockManagementSettingInterceptor extends AbstractInterceptor
{
    /**
     * Ensures "Manage Stock?" is always enabled globally and cannot be disabled.
     *
     * @return void
     * @throws Exception
     */
    public function addHooks() : void
    {
        Register::filter()
            ->setGroup('pre_option_woocommerce_manage_stock')
            ->setHandler([$this, 'enableManageStock'])
            ->setPriority(PHP_INT_MAX)
            ->execute();

        Register::filter()
            ->setGroup('woocommerce_inventory_settings')
            ->setHandler([$this, 'disableManageStockCheckbox'])
            ->execute();
    }

    /**
     * Returns `'yes'` to indicate the setting is enabled.
     *
     * @internal
     *
     * @return string
     */
    public function enableManageStock() : string
    {
        return 'yes';
    }

    /**
     * Adds the `disabled` property to the "Manage Stock?" setting so that the checkbox cannot be unchecked.
     * Also updates the description to indicate why it's disabled.
     *
     * @internal
     *
     * @param array|mixed $settings
     * @return mixed
     */
    public function disableManageStockCheckbox($settings)
    {
        if (! ArrayHelper::accessible($settings)) {
            return $settings;
        }

        foreach ($settings as $key => $setting) {
            if ('woocommerce_manage_stock' === ArrayHelper::get($setting, 'id')) {
                $settings[$key]['disabled'] = true;
                $settings[$key]['desc'] .= sprintf(
                    /* translators: %1$s opening anchor tag; %2$s closing anchor tag */
                    '<p class="description">'.__('Required for storing Product data in Commerce Home. Stock management can be enabled or disabled per product. Learn more about %1$sproduct inventory settings%2$s.', 'mwc-core').'</p>',
                    '<a href="https://woocommerce.com/document/managing-products/#product-data" target="_blank">',
                    '</a>',
                );
                break;
            }
        }

        return $settings;
    }
}
