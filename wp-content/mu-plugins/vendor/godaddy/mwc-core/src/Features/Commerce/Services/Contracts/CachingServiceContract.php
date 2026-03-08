<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Services\Contracts;

use GoDaddy\WordPress\MWC\Common\Contracts\CanConvertToArrayContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\ProductBase;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Customers\Providers\DataObjects\CustomerBase;

/**
 * Contract for services to aid in the caching of remote entities from the platform (e.g. {@see ProductBase} or {@see CustomerBase}).
 */
interface CachingServiceContract
{
    /**
     * Gets a resource from the cache by its remote ID.
     *
     * @param string $remoteId
     * @return object|null
     */
    public function get(string $remoteId) : ?object;

    /**
     * Gets multiple resources from the cache.
     *
     * @param string[] $remoteIds
     * @return object[]
     */
    public function getMany(array $remoteIds) : array;

    /**
     * Adds a resource to the cache.
     *
     * @param CanConvertToArrayContract $resource
     * @return void
     */
    public function set(CanConvertToArrayContract $resource) : void;

    /**
     * Adds multiple resources to the cache.
     *
     * @param CanConvertToArrayContract[] $resources
     * @return void
     */
    public function setMany(array $resources) : void;

    /**
     * Removes a resource from the cache.
     *
     * @param string $remoteId
     * @return void
     */
    public function remove(string $remoteId) : void;
}
