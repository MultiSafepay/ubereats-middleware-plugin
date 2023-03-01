<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use UbereatsPlugin\Ubereats\Enum\DeliveryType;
use CastModels\Model;

class Delivery extends Model
{
    public OrderLocation $location;
    public DeliveryType $type;
    public string $notes;
}
