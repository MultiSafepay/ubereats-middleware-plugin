<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;
use UbereatsPlugin\Ubereats\Models\Allergy;

class SpecialRequest extends Model
{
    public Allergy $allergy;
}
