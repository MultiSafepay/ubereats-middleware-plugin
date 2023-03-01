<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Enum;

enum OrderType: string
{
    use Helper;

    case pick_up = 'PICK_UP';
    case dine_in = 'DINE_IN';
    case delivery_uber = 'DELIVERY_BY_UBER';
    case delivery_restaurant = 'DELIVERY_BY_RESTAURANT';
}
