<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Enum;

enum StoreStatus: string
{
    use Helper;

    case active = 'active';
    case pending_review = 'pending_review';
    case deleted = 'deleted';
    case rejected = 'rejected';
}
