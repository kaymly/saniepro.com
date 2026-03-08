<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services;

use GoDaddy\WordPress\MWC\Common\Exceptions\WordPressDatabaseException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\CommerceException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Contracts\LocationMappingServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Repositories\LocationMapRepository;

class LocationMappingService implements LocationMappingServiceContract
{
    /** @var LocationMapRepository */
    protected LocationMapRepository $locationMapRepository;

    /**
     * The Location Mapping Service constructor.
     */
    public function __construct(LocationMapRepository $locationMapRepository)
    {
        $this->locationMapRepository = $locationMapRepository;
    }

    /**
     * {@inheritDoc}
     *
     * @throws CommerceException
     */
    public function saveRemoteId(string $remoteId) : void
    {
        try {
            $this->locationMapRepository->add(0, $remoteId); //
        } catch (WordPressDatabaseException $exception) {
            throw new CommerceException("A database error occurred trying to save the remote location UUID: {$exception->getMessage()}");
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getRemoteId() : ?string
    {
        return $this->locationMapRepository->getRemoteId(0);
    }
}
