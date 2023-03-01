<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;

class Accounting extends Model
{
    public TaxRemittance $tax_remittance;
    public TaxReporting $tax_reporting;
}
