<?php

declare(strict_types=1);

namespace UbereatsPlugin\Http\Controllers;

use UbereatsPlugin\Http\Requests\Request;

class DeliveryTracking extends Controller
{
    public function __invoke(Request $request): void
    {
        //https://developer.uber.com/docs/eats/api/v1/post-eats-byoc-restaurants-orders-event-location
    }
}
