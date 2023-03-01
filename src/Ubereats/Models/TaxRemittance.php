<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;

class TaxRemittance extends Model
{
    public RemittanceInfo $tax;
    public RemittanceInfo $total_fee_tax;
    public RemittanceInfo $delivery_fee_tax;
    public RemittanceInfo $small_order_fee_tax;
}
