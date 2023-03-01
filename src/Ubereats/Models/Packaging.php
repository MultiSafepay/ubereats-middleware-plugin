<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;

class Packaging extends Model
{
    public DisposableItems $disposable_items;
}
