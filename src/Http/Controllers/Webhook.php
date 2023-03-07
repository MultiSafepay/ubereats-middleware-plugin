<?php

declare(strict_types=1);

namespace UbereatsPlugin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use UbereatsPlugin\Jobs\Webhook as JobWebhook;
use UbereatsModels\Webhook\Webhook as JobModel;
use Illuminate\Support\Facades\Notification;
use Exception;
use Tests\User;

class Webhook extends Controller
{
    public function __invoke(Request $request): void
    {
        Notification::fake();

        User::factory()->create();

        $data = $request->all();

        $this->validateBody($data, $request->header('X-Uber-Signature'));

        $model = new JobModel($data);

        JobWebhook::dispatch($model);
    }

    /**
     * @param array<string, string> $data
     * @param string $signature
     */
    private function validateBody(array &$data, string $signature): void
    {
        $body = hash_hmac('sha256', json_encode($data), config('ubereats.ubereats_api.client_secret'));

        if (! hash_equals($signature, $body)) {
            throw new Exception('error_invalid_signature', Response::HTTP_BAD_REQUEST);
        }
    }
}
