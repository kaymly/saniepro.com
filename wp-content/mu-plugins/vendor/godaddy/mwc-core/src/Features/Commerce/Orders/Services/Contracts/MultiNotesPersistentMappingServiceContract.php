<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services\Contracts;

use GoDaddy\WordPress\MWC\Common\Models\Orders\Note;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Contracts\CanPersistMultiItemsRemoteIdsContract;

/**
 * @extends CanPersistMultiItemsRemoteIdsContract<Note>
 */
interface MultiNotesPersistentMappingServiceContract extends CanPersistMultiItemsRemoteIdsContract
{
}
