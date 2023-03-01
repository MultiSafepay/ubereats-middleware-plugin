<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Enum;

enum Environment: string
{
    use Helper;

    case production = 'production';
    case sandbox = 'sandbox';
}
