<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use UbereatsPlugin\Ubereats\Enum\DeliveryType;
use CastModels\Model;
use Illuminate\Support\Collection;

class Cart extends Model
{
    /** \UbereatsPlugin\Ubereats\Models\Item */
    public Collection $items;
    public string $special_instructions;
    public FulfillmentIssue $fulfillment_issues;
}
