<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use UbereatsPlugin\Ubereats\Enum\Brand;
use UbereatsPlugin\Ubereats\Enum\OrderState;
use UbereatsPlugin\Ubereats\Enum\OrderType;
use CastModels\Model;
use Illuminate\Support\Collection;

class Order extends Model
{
    public string $id;
    public string $uuid;
    public string $external_reference_id;
    public OrderState $current_state;
    public OrderType $type;
    public Brand $brand;
    public Store $store;
    public Eater $eater;
    /** \UbereatsPlugin\Ubereats\Models\Eater */
    public Collection $eaters;
    public Cart $cart;
    public Payment $payment;
    public Packaging $packaging;
    public string $placed_at;
    public string $estimated_ready_for_pickup_at;
    /** \UbereatsPlugin\Ubereats\Models\EatsDelivery */
    public Collection $deliveries;
    public string $order_manager_client_id;
}
