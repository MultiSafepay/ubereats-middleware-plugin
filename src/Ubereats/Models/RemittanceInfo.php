<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;
use Illuminate\Support\Collection;

class RemittanceInfo extends Model
{
    /** \UbereatsPlugin\Ubereats\Models\PayeeDetail */
    public Collection $uber;
    /** \UbereatsPlugin\Ubereats\Models\PayeeDetail */
    public Collection $restaurant;
    /** \UbereatsPlugin\Ubereats\Models\PayeeDetail */
    public Collection $courier;
    /** \UbereatsPlugin\Ubereats\Models\PayeeDetail */
    public Collection $eater;
}
