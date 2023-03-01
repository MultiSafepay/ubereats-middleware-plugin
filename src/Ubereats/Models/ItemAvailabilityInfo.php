<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;

class ItemAvailabilityInfo extends Model
{
    public int $items_requested;
    public int $items_available;
}
