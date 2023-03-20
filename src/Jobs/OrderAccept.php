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

class OrderAccept implements ShouldQueue
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

        $this->acceptOrder();
        $this->confirmAccepted();
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

        $user = null;

        if (class_exists('Tests\User')) {
            /** @phpstan-ignore-next-line */
            $user = \Tests\User::find(1);
        } else {
            /** @phpstan-ignore-next-line */
            $user = \App\Models\User::where('id', 1)->first();
        }

        $user->notify(new NotificationFailure($data));
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
