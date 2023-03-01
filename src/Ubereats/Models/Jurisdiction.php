<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use UbereatsPlugin\Ubereats\Enum\JurisdictionLevel;
use CastModels\Model;

class Jurisdiction extends Model
{
    public JurisdictionLevel $level;
    public string $name;
}
