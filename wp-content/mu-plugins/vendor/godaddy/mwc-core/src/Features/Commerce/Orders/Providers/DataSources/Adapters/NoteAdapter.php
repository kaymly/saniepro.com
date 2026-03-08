<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataSources\Adapters;

use DateTimeInterface;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Models\Orders\Note;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Enums\NoteAuthorType;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Note as NoteDataObject;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataSources\Contracts\DataObjectAdapterContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataSources\Adapters\DateTimeAdapter;

class NoteAdapter implements DataObjectAdapterContract
{
    protected DateTimeAdapter $dateTimeAdapter;

    public function __construct(DateTimeAdapter $dateTimeAdapter)
    {
        $this->dateTimeAdapter = $dateTimeAdapter;
    }

    /**
     * {@inheritDoc}
     * @param NoteDataObject $source
     */
    public function convertFromSource($source) : Note
    {
        return (new Note())
            ->setContent($source->content)
            ->setAuthorName($source->author)
            ->setShouldNotifyCustomer($source->shouldNotifyCustomer)
            ->setCreatedAt($this->convertCreatedAtFromSource($source));
    }

    /**
     * {@inheritDoc}
     * @param Note $target
     */
    public function convertToSource($target) : NoteDataObject
    {
        return new NoteDataObject([
            'author'               => $target->getAuthorName(),
            'authorType'           => $this->convertAuthorTypeToSource($target),
            'createdAt'            => $this->convertCreatedAtToSource($target),
            'content'              => TypeHelper::string($target->getContent(), ''),
            'shouldNotifyCustomer' => $target->getShouldNotifyCustomer(),
        ]);
    }

    /**
     * Converts NoteDataObject createdAt to {@see DateTimeInterface} object.
     *
     * @param NoteDataObject $source
     *
     * @return ?DateTimeInterface
     */
    protected function convertCreatedAtFromSource(NoteDataObject $source) : ?DateTimeInterface
    {
        return $this->dateTimeAdapter->convertFromSource($source->createdAt);
    }

    /**
     * Finds the correct NoteAuthorType enum for the given note.
     *
     * @param Note $target
     *
     * @return NoteAuthorType::*
     */
    protected function convertAuthorTypeToSource(Note $target) : string
    {
        return $target->isAddedBySystem() ? NoteAuthorType::Merchant : NoteAuthorType::None;
    }

    /**
     * Converts Note createdAt to string timestamp.
     *
     * @param Note $target
     *
     * @return non-empty-string|null
     */
    protected function convertCreatedAtToSource(Note $target) : ?string
    {
        return $this->dateTimeAdapter->convertToSource($target->getCreatedAt());
    }
}
