<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;

class DiscountItem extends Model
{
    public string $external_id;
    public int $discounted_quantity;
    public int $discount_amount_applied;
}
