<?php

declare(strict_types=1);

namespace Tests\Webhook;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use UbereatsPlugin\Ubereats\Store\Api;

class StoreActiveOrderTest extends TestCase
{
    use RefreshDatabase;

    public function testGetActiveCreatedOk(): void
    {
        $api = new Api();

        $collection = $api->getActiveCreated(config('ubereats.ubereats_api.test_store'));

        $this->assertEquals(1, $collection->count(), 'Has you created an order on the uber site ?');
    }
}
