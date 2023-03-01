<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;

class PayeeDetail extends Model
{
    public Money $value;
}
