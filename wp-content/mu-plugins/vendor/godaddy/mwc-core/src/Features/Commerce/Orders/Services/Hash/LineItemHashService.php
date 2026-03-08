<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Orders\Services\Hash;

use GoDaddy\WordPress\MWC\Common\Models\Orders\LineItem;

/**
 * @extends AbstractHashService<LineItem>
 */
class LineItemHashService extends AbstractHashService
{
    /**
     * {@inheritDoc}
     */
    protected function getValuesForHash(object $model) : array
    {
        return [
            'LineItem',
            $model->getName(),
            (string) $model->getSku(),
            (string) $model->getQuantity(),
        ];
    }
}
