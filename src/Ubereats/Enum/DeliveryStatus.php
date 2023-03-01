<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Enum;

enum DeliveryStatus: string
{
    use Helper;

    case started = 'started';
    case arriving = 'arriving';
    case delivered = 'delivered';
}
