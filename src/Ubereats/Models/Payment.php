<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;

class Payment extends Model
{
    public Charges $charges;
    public Accounting $accounting;
    public Promotions $promotions;
}
