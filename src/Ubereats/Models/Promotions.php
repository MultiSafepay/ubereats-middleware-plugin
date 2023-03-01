<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;
use Illuminate\Support\Collection;

class Promotions extends Model
{
    /** \UbereatsPlugin\Ubereats\Models\Promotion */
    public Collection $promotions;
}
