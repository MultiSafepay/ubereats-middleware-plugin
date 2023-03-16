<?php

declare(strict_types=1);

use UbereatsPlugin\Http\Controllers\Webhook;
use UbereatsPlugin\Http\Controllers\Menu;
use UbereatsPlugin\Http\Controllers\DeliveryTracking;
use UbereatsPlugin\Http\Controllers\Order;
use Illuminate\Support\Facades\Route;

Route::prefix('ubereats')->group(
    function () {
        Route::post('webhook', Webhook::class);

        Route::middleware(['auth:sanctum'])->group(
            function () {
                Route::post('menu', Menu::class);
                Route::post('delivery_tracking', DeliveryTracking::class);
                Route::post('orders/accept', [Order::class, 'accept']);
                Route::post('orders/deny', [Order::class, 'deny']);
                Route::post('orders/cancel', [Order::class, 'cancel']);
            }
        );
    }
);
