<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;

class ItemPrice extends Model
{
    public Money $unit_price;
    public Money $total_price;
    public Money $base_unit_price;
    public Money $base_total_price;
}
