<?php

declare(strict_types=1);

namespace UbereatsPlugin;

use Illuminate\Support\ServiceProvider;

class UbereatsPluginServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php',
            'ubereats'
        );
    }

    public function boot(): void
    {
        $this->publishes(
            [
                __DIR__.'/../config/config.php' => config_path('config.php'),
            ],
        );

        $this->loadRoutesFrom(__DIR__.'/../routes/ubereats.php');
    }
}
