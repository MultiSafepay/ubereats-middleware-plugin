<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Enum;

enum FulfillmentActionType: string
{
    use Helper;

    case replace_for_me = 'REPLACE_FOR_ME';
    case subtitute_me = 'SUBSTITUTE_ME';
    case cancel = 'CANCEL';
    case remove_item = 'REMOVE_ITEM';
}
