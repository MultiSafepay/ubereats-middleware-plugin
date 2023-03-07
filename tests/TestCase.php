<?php

declare(strict_types=1);

namespace Tests;

use UbereatsPlugin\UbereatsPluginServiceProvider;
use Dotenv\Dotenv;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        $env = Dotenv::createImmutable('/workspace');
        $env->load();

		return [
            UbereatsPluginServiceProvider::class,
		];
    }

    protected function defineDatabaseMigrations()
	{
		$this->loadLaravelMigrations();
	}
}
