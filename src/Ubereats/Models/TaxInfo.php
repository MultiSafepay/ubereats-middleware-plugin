<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use UbereatsPlugin\Ubereats\Enum\TaxInfoType;
use CastModels\Model;
use Illuminate\Support\Collection;

class TaxInfo extends Model
{
    public string $instance_id;
    public TaxInfoType $type;
    public Money $gross_amount;
    public Money $net_amount;
    public Money $total_tax;
    /** \UbereatsPlugin\Ubereats\Models\Tax */
    public Collection $taxes;
}
