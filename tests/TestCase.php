<?php

namespace Tests;

use UbereatsPlugin\UbereatsPluginServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
		return [
            UbereatsPluginServiceProvider::class,
		];
    }
}
