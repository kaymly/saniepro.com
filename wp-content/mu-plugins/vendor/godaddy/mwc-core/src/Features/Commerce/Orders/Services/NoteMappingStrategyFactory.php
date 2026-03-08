<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services;

use GoDaddy\WordPress\MWC\Common\Models\Orders\Note;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Models\Contracts\CommerceContextContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Repositories\NoteMapRepository;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services\Hash\NoteHashService;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Services\AbstractMappingStrategyFactory;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Services\Contracts\MappingStrategyContract;

class NoteMappingStrategyFactory extends AbstractMappingStrategyFactory
{
    protected NoteMapRepository $noteMapRepository;

    protected NoteHashService $noteHashService;

    public function __construct(CommerceContextContract $commerceContext, NoteMapRepository $noteMapRepository, NoteHashService $noteHashService)
    {
        $this->noteMapRepository = $noteMapRepository;
        $this->noteHashService = $noteHashService;

        parent::__construct($commerceContext);
    }

    /**
     * @param Note $model
     * {@inheritDoc}
     */
    public function getPrimaryMappingStrategyFor(object $model) : ?MappingStrategyContract
    {
        if (! $model->getId()) {
            return null;
        }

        return new NoteMappingStrategy($this->noteMapRepository);
    }

    /**
     * {@inheritDoc}
     */
    public function getSecondaryMappingStrategy() : MappingStrategyContract
    {
        return new TemporaryNoteMappingStrategy($this->noteHashService);
    }
}
