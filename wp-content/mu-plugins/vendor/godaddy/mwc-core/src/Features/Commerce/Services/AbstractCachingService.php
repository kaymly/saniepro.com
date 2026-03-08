<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Services;

use GoDaddy\WordPress\MWC\Common\Contracts\CanConvertToArrayContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Services\Contracts\CachingServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Services\Contracts\CachingStrategyContract;

/**
 * Abstract caching service for remote entities.
 */
abstract class AbstractCachingService implements CachingServiceContract
{
    /** @var CachingStrategyContract caching strategy */
    protected CachingStrategyContract $cachingStrategy;

    /** @var string plural name of the resource type (e.g. 'products' or 'customers') -- to be set by concrete implementations */
    protected string $resourceType;

    /** @var int cache TTL (in seconds) for entries */
    protected int $cacheTtl = 30;

    /**
     * Constructor.
     *
     * @param CachingStrategyContract $cachingStrategy
     */
    public function __construct(CachingStrategyContract $cachingStrategy)
    {
        $this->cachingStrategy = $cachingStrategy;
    }

    /**
     * Gets the name of the cache group.
     *
     * @return string
     */
    protected function getCacheGroup() : string
    {
        // @TODO to be implemented in MWC-12144 {agibson 2023-05-10}
        return '';
    }

    /**
     * Gets an item from the cache if it exists, otherwise executes the loader and caches the result.
     *
     * @param string $remoteId
     * @param callable $loader
     * @return object
     */
    public function remember(string $remoteId, callable $loader) : object
    {
        // @TODO to be implemented in MWC-12144 {agibson 2023-05-10}
        return (object) [];
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $remoteId) : ?object
    {
        // TODO to be implemented in MWC-12145 {agibson 2023-05-10}
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getMany(array $remoteIds) : array
    {
        // TODO to be implemented in MWC-12145 {agibson 2023-05-10}
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function set(CanConvertToArrayContract $resource) : void
    {
        // TODO to be implemented in MWC-12146 {agibson 2023-05-10}
    }

    /**
     * {@inheritDoc}
     */
    public function setMany(array $resources) : void
    {
        // TODO to be implemented in MWC-12146 {agibson 2023-05-10}
    }

    /**
     * {@inheritDoc}
     */
    public function remove(string $remoteId) : void
    {
        // TODO to be implemented in MWC-12147 {agibson 2023-05-10}
    }

    /**
     * Converts a JSON-encoded resource into its DTO.
     *
     * @param string $jsonResource JSON-encoded resource
     * @return object|null
     */
    protected function convertJsonResource(string $jsonResource) : ?object
    {
        // TODO to be implemented in MWC-12147 {agibson 2023-05-10}
        return null;
    }

    /**
     * Builds a resource DTO from an array.
     *
     * @param array<string, mixed> $resourceArray
     * @return object
     */
    abstract protected function makeResourceFromArray(array $resourceArray) : object;

    /**
     * Gets the unique remote ID for a given resource.
     *
     * @param object $resource
     * @return string
     */
    abstract protected function getResourceRemoteId(object $resource) : string;
}
