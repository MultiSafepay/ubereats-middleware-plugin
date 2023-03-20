<?php

declare(strict_types=1);

namespace UbereatsPlugin\Jobs;

use UbereatsModels\Enum\EventTypes;
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
use UbereatsModels\Webhook\Webhook as Model;

use Exception;
use Throwable;

class Webhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private Model $model){}

    public function handle(): void
    {
        if (empty($this->model->event_type)) {
            throw new Exception('ubereats_webhook_invalid_request_data');
        }

        $this->process();
    }

    public function failed(Throwable $exception): void
    {
        $data = new NotificationFailureModel(
            [
                'logLevel' => LogLevel::emergency->value,
                'problem' => $exception->getMessage(),
                'data' => $this->model->toArray()
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

    private function process(): void
    {
        $eventType = $this->model->event_type;

        if ($eventType == EventTypes::store_provisioned->value) {
            $this->storeProvisioned();
        }

        if ($eventType == EventTypes::order_notification->value) {
            $this->orderNotification();
        }

        if ($eventType == EventTypes::order_cancel->value) {
            $this->orderCancelled();
        }
    }

    private function storeProvisioned(): void
    {
        if (empty($this->model->perform_refresh_menu)) {
            return;
        }

        if (empty($this->model->store_id)) {
            throw new Exception('invalid_request_data_empty_store_id');
        }

        $api = new BackendApi();

        $api->webhook(EventTypes::store_provisioned->value, $this->model->toArray());
    }

    private function orderNotification(): void
    {
        $orderApi = new OrderApi();
        $api = new BackendApi();

        $order = $orderApi->getDetails($this->model->meta->resource_id);

        $api->webhook(EventTypes::order_notification->value, $order->toArray());
    }

    private function orderCancelled(): void
    {
        $api = new BackendApi();

        $api->webhook(EventTypes::order_cancel->value, $this->model->toArray());
    }
}
