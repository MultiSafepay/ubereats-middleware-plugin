<?php

declare(strict_types=1);

namespace UbereatsPlugin\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use UbereatsPlugin\Ubereats\Order\Api as OrderApi;
use NotificationFailure\Model as NotificationFailureModel;
use NotificationFailure\Notification as NotificationFailure;
use NotificationFailure\LogLevel;
use Illuminate\Support\Facades\DB;
use UbereatsPlugin\Api\ApiRequest as BackendApi;
use Throwable;

class OrderDeny implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

        $this->denyOrder();
        $this->confirmDeny();
    }

    public function failed(Throwable $exception): void
    {
        $data = new NotificationFailureModel(
            [
                'logLevel' => LogLevel::emergency->value,
                'problem' => $exception->getMessage(),
                'data' => $this->data
            ]
        );

        $user = DB::table('users')->where('id', 1);

        /** @phpstan-ignore-next-line */
        $user->notify(new NotificationFailure($data));
    }

    private function denyOrder(): void
    {
        $orderApi = new OrderApi();

        $orderApi->deny($this->data['orderId']);
    }

    private function confirmDeny(): void
    {
        $api = new BackendApi();

        $api->confirm('order-deny', $this->data);
    }
}
