<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataSources\Adapters;

use DateTime;
use DateTimeZone;
use Exception;
use GoDaddy\WordPress\MWC\Common\Contracts\HasStringRemoteIdentifierContract;
use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Common\Exceptions\AdapterException;
use GoDaddy\WordPress\MWC\Common\Exceptions\SentryException;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Platforms\Exceptions\PlatformRepositoryException;
use GoDaddy\WordPress\MWC\Common\Platforms\PlatformRepositoryFactory;
use GoDaddy\WordPress\MWC\Common\Repositories\WooCommerceRepository;
use GoDaddy\WordPress\MWC\Common\Traits\CanGetNewInstanceTrait;
use GoDaddy\WordPress\MWC\Common\Traits\HasStringRemoteIdentifierTrait;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\AbstractOption;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductBase;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\VariantOptionMapping;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ProductsMappingServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\MissingProductRemoteIdForParentException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataObjects\SimpleMoney;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataSources\Adapters\SimpleMoneyAdapter;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Models\Products\Product;

/**
 * Adapter to convert between a native {@see Product model} and a {@see ProductBase} DTO.
 *
 * @method static static getNewInstance(ProductsMappingServiceContract $productMappingService)
 */
class ProductBaseAdapter implements DataSourceAdapterContract, HasStringRemoteIdentifierContract
{
    use CanGetNewInstanceTrait;
    use HasStringRemoteIdentifierTrait;

    /** @var ProductsMappingServiceContract */
    protected ProductsMappingServiceContract $productMappingService;

    /**
     * Constructor.
     *
     * @param ProductsMappingServiceContract $productsMappingService
     */
    public function __construct(ProductsMappingServiceContract $productsMappingService)
    {
        $this->productMappingService = $productsMappingService;
    }

    /**
     * Converts a native {@see Product model} into a {@see ProductBase} DTO.
     *
     * @param Product|null $product
     * @return ProductBase
     * @throws AdapterException|Exception|MissingProductRemoteIdForParentException
     */
    public function convertToSource(Product $product = null) : ProductBase
    {
        if (! $product) {
            throw new AdapterException('Cannot convert a null product to a ProductBase DTO');
        }

        $productName = $product->getName();

        if (empty($productName)) {
            throw new AdapterException('Cannot convert a product to a ProductBase DTO without a name');
        }

        $hasVariants = ! empty($product->getVariants());

        return new ProductBase([
            'active'                      => 'publish' === $product->getStatus(), // We cannot use $product->isPurchasable() here because that checks that the `_price` meta value is not empty, which hasn't been set at this point in time.
            'allowCustomPrice'            => false,
            'altId'                       => $this->convertSlugToSource($product),
            'assets'                      => MediaAdapter::getNewInstance()->convertToSource($product),
            'brand'                       => $product->getMarketplacesBrand(), // todo: is this correct?
            'categoryIds'                 => $this->convertCategoriesToSource($product),
            'channelIds'                  => $this->convertChannelIdsToSource(),
            'createdAt'                   => $this->convertDateToSource($product->getCreatedAt()),
            'condition'                   => $this->convertProductConditionToSource($product),
            'description'                 => $product->getDescription() ?: null,
            'ean'                         => null, // We don't have EAN data.
            'externalIds'                 => ExternalIdsAdapter::getNewInstance()->convertToSource($product),
            'files'                       => FilesAdapter::getNewInstance()->convertToSource($product),
            'inventory'                   => InventoryAdapter::getNewInstance()->convertToSource($product),
            'manufacturerData'            => null, // We don't have meaningful manufacturer data to send.
            'name'                        => $productName,
            'options'                     => $this->convertOptionsToSource($product),
            'parentId'                    => $this->convertLocalParentIdToRemoteParentUuid($product->getParentId()),
            'price'                       => ! $hasVariants ? SimpleMoneyAdapter::getNewInstance()->convertToSource($product->getRegularPrice()) : new SimpleMoney(['value' => 0, 'currencyCode' => WooCommerceRepository::getCurrency()]), // Parent variable product prices are disregarded in Commerce.
            'productId'                   => null, // We don't have the remote product ID.
            'purchasable'                 => ! $hasVariants, // Parent variable products in Commerce are not purchasable by design.
            'salePrice'                   => ! $hasVariants ? SimpleMoneyAdapter::getNewInstance()->convertToSource($product->getSalePrice()) : null, // Parent variable product sale prices are disregarded in Commerce.
            'shippingWeightAndDimensions' => ShippingWeightAndDimensionsAdapter::getNewInstance()->convertToSource($product),
            'shortCode'                   => null, // We don't have shortcode data.
            'sku'                         => $product->getSku(),
            'taxCategory'                 => $product->getTaxCategory() ?: null,
            'type'                        => $this->convertProductTypeToSource($product),
            'updatedAt'                   => $this->convertDateToSource($product->getUpdatedAt()),
            'variantOptionMapping'        => $this->convertVariantOptionMappingToSource($product),
        ]);
    }

    /**
     * Converts channel IDs to source.
     *
     * @return string[]
     */
    protected function convertChannelIdsToSource() : array
    {
        try {
            $channelId = PlatformRepositoryFactory::getNewInstance()->getPlatformRepository()->getChannelId();

            return [$channelId];
        } catch (PlatformRepositoryException $exception) {
            new SentryException($exception->getMessage(), $exception);

            return [];
        }
    }

    /**
     * Converts the product condition to source.
     *
     * @param Product $product
     * @return string|null
     */
    protected function convertProductConditionToSource(Product $product) : ?string
    {
        $condition = strtoupper($product->getMarketplacesCondition() ?: '');

        return ArrayHelper::contains([ProductBase::CONDITION_NEW, ProductBase::CONDITION_RECONDITIONED, ProductBase::CONDITION_REFURBISHED, ProductBase::CONDITION_USED], $condition)
            ? $condition
            : null;
    }

    /**
     * Converts the product type.
     *
     * @param Product $product
     * @return string
     */
    protected function convertProductTypeToSource(Product $product) : string
    {
        $type = ProductBase::TYPE_PHYSICAL;

        if ($product->isVirtual()) {
            $type = ProductBase::TYPE_SERVICE;
        }

        if ($product->isDownloadable()) {
            $type = ProductBase::TYPE_DIGITAL;
        }

        return $type;
    }

    /**
     * Exchanges a local (WooCommerce) parent ID for a Commerce UUID.
     *
     * @see ProductPostAdapter::convertRemoteParentUuidToLocalParentId()
     *
     * @param int|null $localParentId
     * @return string|null
     * @throws MissingProductRemoteIdForParentException
     */
    protected function convertLocalParentIdToRemoteParentUuid(?int $localParentId) : ?string
    {
        if (empty($localParentId)) {
            return null;
        }

        $remoteParentId = $this->productMappingService->getRemoteId(Product::getNewInstance()->setId($localParentId));

        if (! $remoteParentId) {
            // throwing an exception here prevents us from incorrectly identifying the product as having no parent in Commerce
            throw new MissingProductRemoteIdForParentException("Failed to retrieve remote ID for parent product {$localParentId}.");
        }

        return $remoteParentId;
    }

    /**
     * Converts the categories to an array of category IDs.
     *
     * @param Product $product
     * @return array<string> category IDs
     */
    protected function convertCategoriesToSource(Product $product) : array
    {
        // no-op for now
        return [];
    }

    /**
     * Converts a datetime object to a string using the `Y-m-d\TH:i:s\Z` format and UTC timezone.
     *
     * @param DateTime|null $date
     * @return string|null
     */
    protected function convertDateToSource(?DateTime $date) : ?string
    {
        if (! $date) {
            return null;
        }

        // ensures that the date is in UTC
        return $date->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d\TH:i:s\Z');
    }

    /**
     * Converts the slug to a valid Commerce API "altId" value.
     *
     * @param Product $product
     * @return string|null
     */
    protected function convertSlugToSource(Product $product) : ?string
    {
        $slug = $product->getSlug();

        // strip disallowed characters
        $slug = preg_replace('/[^A-Za-z0-9-_]+/', '', $slug ?? '');

        if (empty($slug) || strlen($slug) < 3) {
            return null;
        }

        return substr($slug, 0, 128);
    }

    /**
     * Converts source product attributes into Commerce API options.
     *
     * @param Product $product
     * @return AbstractOption[]|null
     */
    protected function convertOptionsToSource(Product $product) : ?array
    {
        $options = null;
        $attributes = $product->getAttributes();

        if ($attributes) {
            $options = [];

            foreach ($attributes as $attribute) {
                if ($option = OptionAdapter::getNewInstance()->convertToSource($attribute)) {
                    $options[] = $option;
                }
            }
        }

        return $options;
    }

    /**
     * Converts attribute mapping to source.
     *
     * @param Product $product
     * @return VariantOptionMapping[]|null
     */
    protected function convertVariantOptionMappingToSource(Product $product) : ?array
    {
        $variantAttributeMapping = $product->getVariantAttributeMapping();

        if (! $variantAttributeMapping) {
            return null;
        }

        $options = [];

        foreach ($variantAttributeMapping as $attributeName => $attributeValue) {
            $options[] = VariantOptionMapping::getNewInstance([
                'name'  => $attributeName,
                'value' => $attributeValue ? $attributeValue->getName() : '',
            ]);
        }

        return $options;
    }

    /**
     * {@inheritDoc}
     */
    public function convertFromSource()
    {
        // no-op for now
    }
}
