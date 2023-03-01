<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use UbereatsPlugin\Ubereats\Enum\TaxRemittance;
use CastModels\Model;

class Tax extends Model
{
    public string $rate;
    public Money $tax_amount;
    public bool $is_inclusive;
    public Jurisdiction $jurisdiction;
    public Imposition $imposition;
    public TaxRemittance $tax_remittance;
}
