<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\Contracts;

use GoDaddy\WordPress\MWC\Common\Contracts\CanConvertToArrayContract;

interface ListProductsOperationContract extends CanConvertToArrayContract
{
    /**
     * Set the local IDs.
     *
     * @param ?array<int> $ids
     * @return ListProductsOperationContract
     */
    public function setLocalIds(?array $ids) : ListProductsOperationContract;

    /**
     * Get local IDs.
     *
     * @return ?array<int>
     */
    public function getLocalIds() : ?array;

    /**
     * Sets the remote (Commerce) product IDs.
     *
     * @param string[]|null $value
     * @return ListProductsOperationContract
     */
    public function setIds(?array $value) : ListProductsOperationContract;

    /**
     * Gets the remote (Commerce) product IDs.
     *
     * @return string[]|null
     */
    public function getIds() : ?array;

    /**
     * Set the include deleted flag.
     *
     * @param ?bool $includeDeleted
     * @return ListProductsOperationContract
     */
    public function setIncludeDeleted(?bool $includeDeleted) : ListProductsOperationContract;

    /**
     * Get the include deleted flag.
     *
     * @return ?bool
     */
    public function getIncludeDeleted() : ?bool;

    /**
     * Set the sort by.
     *
     * @param ?string $sortBy
     * @return ListProductsOperationContract
     */
    public function setSortBy(?string $sortBy) : ListProductsOperationContract;

    /**
     * Get the sort by.
     *
     * @return ?string
     */
    public function getSortBy() : ?string;

    /**
     * Set the sort order.
     *
     * @param ?string $sortOrder
     * @return ListProductsOperationContract
     */
    public function setSortOrder(?string $sortOrder) : ListProductsOperationContract;

    /**
     * Get the sort order.
     *
     * @return ?string
     */
    public function getSortOrder() : ?string;

    /**
     * Set the category ID.
     *
     * @param ?int $localCategoryId
     * @return ListProductsOperationContract
     */
    public function setLocalCategoryId(?int $localCategoryId) : ListProductsOperationContract;

    /**
     * Get the category ID.
     *
     * @return ?int
     */
    public function getLocalCategoryId() : ?int;

    /**
     * Set the channel ID.
     *
     * @param ?string $channelId
     * @return ListProductsOperationContract
     */
    public function setChannelId(?string $channelId) : ListProductsOperationContract;

    /**
     * Get the channel ID.
     *
     * @return ?string
     */
    public function getChannelId() : ?string;

    /**
     * Set the SKU.
     *
     * @param ?string $sku
     * @return ListProductsOperationContract
     */
    public function setSku(?string $sku) : ListProductsOperationContract;

    /**
     * Get the SKU.
     *
     * @return ?string
     */
    public function getSku() : ?string;

    /**
     * Set the alt ID.
     *
     * @param ?string $altId
     * @return ListProductsOperationContract
     */
    public function setAltId(?string $altId) : ListProductsOperationContract;

    /**
     * Get the alt ID.
     *
     * @return ?string
     */
    public function getAltId() : ?string;

    /**
     * Set the name.
     *
     * @param ?string $name
     * @return ListProductsOperationContract
     */
    public function setName(?string $name) : ListProductsOperationContract;

    /**
     * Get the name.
     *
     * @return ?string
     */
    public function getName() : ?string;

    /**
     * Set the type.
     *
     * @param ?string $type
     * @return ListProductsOperationContract
     */
    public function setType(?string $type) : ListProductsOperationContract;

    /**
     * Get the type.
     *
     * @return ?string
     */
    public function getType() : ?string;

    /**
     * Set the page token.
     *
     * @param ?string $pageToken
     * @return ListProductsOperationContract
     */
    public function setPageToken(?string $pageToken) : ListProductsOperationContract;

    /**
     * Get the page token.
     *
     * @return ?string
     */
    public function getPageToken() : ?string;

    /**
     * Set the token direction.
     *
     * @param ?string $tokenDirection
     * @return ListProductsOperationContract
     */
    public function setTokenDirection(?string $tokenDirection) : ListProductsOperationContract;

    /**
     * Get the token direction.
     *
     * @return ?string
     */
    public function getTokenDirection() : ?string;
}
