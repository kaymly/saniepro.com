<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Locations\Interceptors;

use Exception;
use GoDaddy\WordPress\MWC\Common\Configuration\Configuration;
use GoDaddy\WordPress\MWC\Common\Enqueue\Enqueue;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\SanitizationHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Interceptors\AbstractInterceptor;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Common\Repositories\WooCommerce\OrdersRepository;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPressRepository;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\Contracts\CommerceExceptionContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Locations\Providers\DataObjects\Contact;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Locations\Providers\DataObjects\Location;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Locations\Services\LocationsService;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataObjects\Address;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Adapters\OrderAdapter;
use WC_Order_Item_Shipping;
use WC_Shipping_Rate;

/**
 * Interceptor to handle the Local Pickup frontend customer components.
 */
class LocalPickupCustomerInterceptor extends AbstractInterceptor
{
    protected LocationsService $locationsService;

    /**
     * @param LocationsService $locationsService
     */
    public function __construct(LocationsService $locationsService)
    {
        $this->locationsService = $locationsService;
    }

    /**
     * Adds the hook to register.
     *
     * @throws Exception
     */
    public function addHooks() : void
    {
        Register::action()
            ->setGroup('woocommerce_after_shipping_rate')
            ->setHandler([$this, 'maybeAddPickupLocationFields'])
            ->execute();

        Register::action()
            ->setGroup('woocommerce_thankyou')
            ->setPriority(1)
            ->setHandler([$this, 'maybeAddPickupLocationToThankYouPage'])
            ->execute();

        Register::action()
            ->setGroup('woocommerce_checkout_create_order_shipping_item')
            ->setHandler([$this, 'maybeSetShippingItemLocation'])
            ->execute();

        Register::action()
            ->setGroup('wp_enqueue_scripts')
            ->setHandler([$this, 'enqueueAssets'])
            ->execute();
    }

    /**
     * Enqueues the JavaScript file.
     *
     * @internal
     *
     * @return void
     * @throws Exception
     */
    public function enqueueAssets() : void
    {
        Enqueue::script()
            ->setHandle('mwc-checkout-local-pickup-selector')
            ->setSource(WordPressRepository::getAssetsUrl('js/features/commerce/frontend/checkout-local-pickup-selector.js'))
            ->setVersion(TypeHelper::string(Configuration::get('mwc.version'), ''))
            ->setDependencies(['jquery'])
            ->setDeferred(true)
            ->execute();

        Enqueue::style()
            ->setHandle('mwc-checkout-local-pickup-selector-checkout')
            ->setSource(WordPressRepository::getAssetsUrl('css/features/commerce/frontend/checkout-page.css'))
            ->execute();
    }

    /**
     * Adds the pickup location fields.
     *
     * @param mixed $method
     */
    public function maybeAddPickupLocationFields($method) : void
    {
        if (! $method instanceof WC_Shipping_Rate) {
            return;
        }

        if ('local_pickup' !== ($methodId = $method->get_method_id())) {
            return;
        }

        $instanceId = (string) $method->get_instance_id();

        try {
            $pickupLocations = $this->locationsService->getLocationsForShippingMethodInstance($methodId, $instanceId);

            if (empty($pickupLocations)) {
                $this->renderNoPickupLocationsAvailable();
            } else {
                ?>
                <br>
                <div class="mwc-commerce-local-pickup-locations-title">
                    <?php esc_html_e('Available Pickup Locations', 'mwc-core') ?>
                </div>
                <div class="mwc-commerce-local-pickup-locations-wrapper">
                    <?php
                    foreach ($pickupLocations as $location) {
                        $this->renderPickupLocationField($location, $instanceId);
                    }
                ?>
                </div>
                <?php
            }
        } catch (CommerceExceptionContract|Exception $exception) {
            $this->renderNoPickupLocationsAvailable();
        }
    }

    /**
     * Adds the no pickup locations available message.
     *
     * @return void
     */
    protected function renderNoPickupLocationsAvailable() : void
    {
        ?>
        <br><span class="title"><?php esc_html_e('No pickup locations available', 'mwc-core') ?></span>
        <div class="mwc-commerce-local-pickup-location__missing">
            <?php esc_html_e('Please choose another shipping method, or contact the store for a pickup location.', 'mwc-core') ?>
        </div>
        <?php
    }

    /**
     * Adds the pickup location fields.
     *
     * @param Location $location
     * @param string $instanceId
     */
    protected function renderPickupLocationField(Location $location, string $instanceId) : void
    {
        ?>
        <div class="mwc-commerce-local-pickup-location-wrapper">
            <input
                type="radio"
                id="mwc-commerce-local-pickup-location-<?php echo esc_attr($instanceId); ?>-<?php echo esc_attr($location->channelId); ?>"
                name="mwc-commerce-local-pickup-location-selection-<?php echo esc_attr($instanceId); ?>"
                class="mwc-commerce-local-pickup-location"
                value="<?php echo esc_attr($location->channelId); ?>"
            />
            <label
                class="mwc-commerce-local-pickup-location__label"
                for="mwc-commerce-local-pickup-location-<?php echo esc_attr($instanceId); ?>-<?php echo esc_attr($location->channelId); ?>"
            >
                <span class="mwc-commerce-local-pickup-location__title">
                    <?php echo esc_attr($location->alias); ?>
                </span>
                <?php $this->renderAddress($location->address); ?>
                <?php $this->renderPhone($location->contacts); ?>
            </label>
        </div>
        <br>
        <?php
    }

    /**
     * Adds the pickup location information to the thank you page.
     *
     * @param Location $location
     */
    protected function renderPickupLocationForThankYouSection(Location $location) : void
    {
        ?>
            <div class="mwc-commerce-local-pickup-location__label">
                <span class="mwc-commerce-local-pickup-location__title">
                    <?php echo esc_attr($location->alias); ?>
                </span>
                <?php $this->renderAddress($location->address); ?>
                <?php $this->renderPhone($location->contacts); ?>
            </div>
        <?php
    }

    /**
     * Adds the pickup location address.
     *
     * @param Address $address
     */
    protected function renderAddress(Address $address) : void
    {
        $streetAddress = $address->address1;

        if ($address->address2) {
            $streetAddress .= ', '.$address->address2;
        }

        ?>
        <div class="mwc-commerce-local-pickup-location__address">
            <?php echo esc_html($streetAddress.', '.$address->city.', '.$address->state.' '.$address->postalCode); ?>
        </div>
        <?php
    }

    /**
     * Adds the pickup location phone.
     *
     * @param Contact[] $contacts
     */
    protected function renderPhone(array $contacts) : void
    {
        foreach ($contacts as $contact) {
            if ($contact->type === Contact::TYPE_WORK) {
                ?>
                <div class="mwc-commerce-local-pickup-location__phone">
                    <?php echo esc_html($contact->phone->phone); ?>
                </div>
                <?php
                break;
            }
        }
    }

    /**
     * Sets the shipping item location from checkout form input.
     *
     * @param mixed $item
     */
    public function maybeSetShippingItemLocation($item) : void
    {
        if (! $item instanceof WC_Order_Item_Shipping) {
            return;
        }

        if ('local_pickup' !== $item->get_method_id()) {
            return;
        }

        if (! $chosenLocationId = SanitizationHelper::input(TypeHelper::string(ArrayHelper::get($_POST, "mwc-commerce-local-pickup-location-selection-{$item->get_instance_id()}"), ''))) {
            return;
        }

        $item->update_meta_data('godaddy_mwc_commerce_location_id', $chosenLocationId);
    }

    /**
     * Adds the pickup location fields.
     *
     * @param int $orderId
     */
    public function maybeAddPickupLocationToThankYouPage($orderId) : void
    {
        $wcOrder = OrdersRepository::get((int) $orderId);

        if (! $wcOrder instanceof \WC_Order) {
            return;
        }

        try {
            $pickupLocations = $this->locationsService->getLocationsForOrder(OrderAdapter::getNewInstance($wcOrder)->convertFromSource());

            if (! empty($pickupLocations)) {
                echo '<section class="mwc-commerce-local-pickup-location-wrapper">';
                echo '<h2 class="woocommerce-column__title">'.__('Pickup Location Information', 'mwc-core').'</h2>';
                foreach ($pickupLocations as $pickupLocation) {
                    ?>
                    <p>
                    <?php $this->renderPickupLocationForThankYouSection($pickupLocation) ?>
                    </p>
                    <?php
                }
                echo '</section>';
            }
        } catch (CommerceExceptionContract|Exception $exception) {
        }
    }
}
