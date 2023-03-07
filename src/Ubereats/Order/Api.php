<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Order;

use UbereatsModels\Login\Scope;
use UbereatsModels\Order\DeliveryStatus;
use UbereatsModels\Order\Order;
use UbereatsPlugin\Ubereats\ApiRequest;

class Api
{
    private ApiRequest $api;

    public function __construct()
    {
        $this->api = ApiRequest::v1(Scope::order);
    }

    public function accept(string $orderId, string $reason = 'accepted'): void
    {
        $api = ApiRequest::v2(Scope::order);
        $api->send('POST', "/orders/$orderId/accept_pos_order", ['reason' => $reason]);
    }

    public function cancel(string $orderId): void
    {
        $api = ApiRequest::v2(Scope::order);
        $api->send('POST', "/orders/$orderId/cancel");
    }

    public function deny(string $orderId, string $reason = 'unspecified'): void
    {
        $data = [
            'reason' => [
                'explanation' => $reason,
                'code' => 'OTHER',
            ],
        ];

        $this->api->send('POST', "/orders/$orderId/deny_pos_order", $data);
    }

    public function updateDeliveryStatus(string $orderId, DeliveryStatus $status): void
    {
        $this->api->send('POST', "/orders/$orderId/restaurantdelivery/status", ['status' => $status->value]);
    }

    public function getDetails(string $orderId): Order
    {
        $api = ApiRequest::v2(Scope::order);
        $data = $api->send('GET', "/orders/$orderId");

        return new Order($data);
    }
}
