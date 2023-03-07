<?php

declare(strict_types=1);

namespace Tests\Webhook;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\User;

class StoreProvisionedTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreProvisionedOk(): void
    {
        Notification::fake();

        User::factory()->create();

        $file = file_get_contents(__DIR__.'/store-provisioned.json');
        $data = json_decode($file, true);

        $signature = hash_hmac('sha256', json_encode($data), config('ubereats.ubereats_api.client_secret'));

        $response = $this->post('/ubereats/webhook', $data, ['X-Uber-Signature' => $signature]);

        $response->assertOk();

        Notification::assertNothingSent();
    }
}
