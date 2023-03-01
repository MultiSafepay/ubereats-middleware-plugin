<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use UbereatsPlugin\Ubereats\Enum\FulfillmentActionType;
use CastModels\Model;
use Illuminate\Support\Collection;

class FulfillmentAction extends Model
{
    public FulfillmentActionType $fulfillment_action_type;
    /** \CastModels\Model\Item */
    public Collection $item_substitutes;
}
