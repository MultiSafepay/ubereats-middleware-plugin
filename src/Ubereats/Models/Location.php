<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;

class Location extends Model
{
    public string $address;
    public string $address_2;
    public string $city;
    public string $country;
    public string $postal_code;
    public string $state;
    public float $latitude;
    public float $longitude;
}
