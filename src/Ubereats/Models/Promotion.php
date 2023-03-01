<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use UbereatsPlugin\Ubereats\Enum\PromoType;
use CastModels\Model;
use Illuminate\Support\Collection;

class Promotion extends Model
{
    public string $external_promotion_id;
    public PromoType $promo_type;
    public int $promo_discount_value;
    public int $promo_discount_percentage;
    public int $promo_delivery_fee_value;
    /** \UbereatsPlugin\Ubereats\Models\DiscountItem */
    public Collection $discount_items;
}
