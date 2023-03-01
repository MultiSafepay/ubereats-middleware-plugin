<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use UbereatsPlugin\Ubereats\Enum\StoreStatus;
use CastModels\Model;

class Store extends Model
{
    public string $name;
    public string $store_id;
    public Location $location;
    /**
     * @var array<string, string> $contact_emails
     */
    public array $contact_emails;
    public string $raw_hero_url;
    public string $price_bucket;
    public int $avg_prep_time;
    public StoreStatus $status;
    public string $merchant_store_id;
    public string $timezone;
    public string $web_url;
    public PosData $pos_data;
}
