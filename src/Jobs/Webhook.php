<?php

declare(strict_types=1);

namespace UbereatsPlugin\Jobs;

use UbereatsPlugin\Ubereats\Enum\EventTypes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use UbereatsPlugin\Ubereats\Models\Webhook as Model;
use UbereatsPlugin\Ubereats\Order\Api as OrderApi;
use NotificationFailure\Model as NotificationFailureModel;
use NotificationFailure\Notification as NotificationFailure;
use NotificationFailure\LogLevel;
use Illuminate\Support\Facades\DB;
use UbereatsPlugin\Api\ApiRequest as BackendApi;
use Exception;
use Throwable;

class Webhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Model $model;

    /**
     * Execute the job.
     *
     * @param array<string, array<string>>|array<string, string> $request
     *
     * @return void
     */
    public function handle(array $request): void
    {
        $model = new Model($request);

        if (empty($model->event_type)) {
            throw new Exception('ubereats_webhook_invalid_request_data');
        }

        $this->model = $model;

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

        $user = DB::table('users')->where('id', 1);

        /** @phpstan-ignore-next-line */
        $user->notify(new NotificationFailure($data));
    }

    private function process(): void
    {
        $eventType = $this->model->event_type;

        if ($eventType == EventTypes::store_provisioned) {
            $this->storeProvisioned();
        }

        if ($eventType == EventTypes::order_notification) {
            $this->orderNotification();
        }

        if ($eventType == EventTypes::order_cancel) {
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
