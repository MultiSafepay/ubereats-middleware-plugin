<?php

declare(strict_types=1);

namespace Tests\Webhook;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use UbereatsPlugin\Ubereats\Store\Api;

class ReadAllTest extends TestCase
{
    use RefreshDatabase;

    public function testReadAllTestOk(): void
    {
        $api = new Api();

        $collection = $api->get();

        $this->assertEquals(4, $collection->count());
    }
}
