<?php

declare(strict_types=1);

namespace UbereatsPlugin\Http\Controllers;

use UbereatsPlugin\Http\Requests\Order as Request;
use UbereatsPlugin\Jobs\OrderAccept;
use UbereatsPlugin\Jobs\OrderDeny;
use UbereatsPlugin\Jobs\OrderCancel;

class Order extends Controller
{
    public function accept(Request $request): void
    {
        $job = new OrderAccept();

        $job->dispatch($request->all());
    }

    public function deny(Request $request): void
    {
        $job = new OrderDeny();

        $job->dispatch($request->all());
    }

    public function cancel(Request $request): void
    {
        $job = new OrderCancel();

        $job->dispatch($request->all());
    }
}
