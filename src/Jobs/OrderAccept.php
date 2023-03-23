<?php

declare(strict_types=1);

namespace UbereatsPlugin\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use UbereatsPlugin\Ubereats\Order\Api as OrderApi;
use UbereatsPlugin\Api\ApiRequest as BackendApi;
use Throwable;

class OrderAccept implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Failed;

    /**
     *
     * @var array<string, array<string>>|array<string, string> $data
     */
    private array $data;

    /**
     * Execute the job.
     *
     * @param array<string, array<string>>|array<string, string> $request
     *
     * @return void
     */
    public function handle(array $request): void
    {
        $this->data = $request;

        $this->acceptOrder();
        $this->confirmAccepted();
    }

    private function acceptOrder(): void
    {
        $orderApi = new OrderApi();

        $orderApi->accept($this->data['orderId']);
    }

    private function confirmAccepted(): void
    {
        $api = new BackendApi();

        $api->confirm('order-acceptted', $this->data);
    }
}
