<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;
use Illuminate\Support\Collection;

class TaxBreakdown extends Model
{
    /** \UbereatsPlugin\Ubereats\Models\TaxInfo */
    public Collection $items;
    /** \UbereatsPlugin\Ubereats\Models\TaxInfo */
    public Collection $fees;
    /** \UbereatsPlugin\Ubereats\Models\TaxInfo */
    public Collection $promotions;
}
