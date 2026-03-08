<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services\Contracts;

use GoDaddy\WordPress\MWC\Common\Models\Orders\Note;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Contracts\CanSaveMultiItemsRemoteIdsContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Providers\DataObjects\Note as CommerceNote;

/**
 * @extends CanSaveMultiItemsRemoteIdsContract<Note, CommerceNote>
 */
interface MultiNotesMappingServiceContract extends CanSaveMultiItemsRemoteIdsContract
{
}
