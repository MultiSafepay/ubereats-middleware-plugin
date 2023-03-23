<?php

declare(strict_types=1);

namespace UbereatsPlugin\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use UbereatsPlugin\Ubereats\Menu\Api;

class Menu implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Failed;

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
}
