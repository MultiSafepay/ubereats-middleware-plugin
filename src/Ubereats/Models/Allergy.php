<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;
use Illuminate\Support\Collection;

class Allergy extends Model
{
    /** \UbereatsPlugin\Ubereats\Models\Allergen */
    public Collection $allergens_to_exclude;
    public string $allergy_instructions;
}
