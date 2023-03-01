<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Enum;

enum TaxRemittance: string
{
    use Helper;

    case uber = 'UBER';
    case merchant = 'MERCHANT';
}
