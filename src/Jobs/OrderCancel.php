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

class OrderCancel implements ShouldQueue
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

        $this->cancelOrder();
        $this->confirmCancel();
    }

    private function cancelOrder(): void
    {
        $orderApi = new OrderApi();

        $orderApi->cancel($this->data['orderId']);
    }

    private function confirmCancel(): void
    {
        $api = new BackendApi();

        $api->confirm('order-cancelled', $this->data);
    }
}
