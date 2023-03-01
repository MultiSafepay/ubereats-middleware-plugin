<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Enum;

enum OrderState: string
{
    use Helper;

    case created = 'CREATED';
    case accepted = 'ACCEPTED';
    case denied = 'DENIED';
    case finished = 'FINISHED';
    case canceled = 'CANCELED';
    case unknown = 'UNKNOWN';
}
