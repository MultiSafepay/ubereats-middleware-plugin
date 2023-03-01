<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Enum;

enum Brand: string
{
    use Helper;

    case uber_eats = 'UBER_EATS';
    case postmates = 'POSTMATES';
}
