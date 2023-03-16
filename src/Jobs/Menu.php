<?php

declare(strict_types=1);

namespace UbereatsPlugin\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use NotificationFailure\Model as NotificationFailureModel;
use NotificationFailure\Notification as NotificationFailure;
use NotificationFailure\LogLevel;
use Illuminate\Support\Facades\DB;
use UbereatsPlugin\Ubereats\Menu\Api;

use Throwable;

class Menu implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     *
     * @param array<string, array<string>>|array<string, string> $data
     */
    public function __construct(private array $data)
    {}

    public function handle(): void
    {
        $api = new Api();
        $api->upload($this->data['storeId'], $this->data['menus']);
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
}
