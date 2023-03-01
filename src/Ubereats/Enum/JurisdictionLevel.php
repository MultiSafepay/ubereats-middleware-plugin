<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Enum;

enum JurisdictionLevel: string
{
    use Helper;

    case city = 'CITY';
    case state = 'STATE';
    case county = 'COUNTY';
    case district = 'DISTRICT';
}
