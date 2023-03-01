<?php

declare(strict_types=1);

namespace UbereatsPlugin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use UbereatsPlugin\Ubereats\Enum\Environment;
use UbereatsPlugin\Jobs\Webhook as JobWebhook;
use Exception;

class Webhook extends Controller
{
    private Request $request;

    public function __invoke(Request $request): void
    {
        $this->request = $request;

        $this->validateBody();

        $job = new JobWebhook();

        $job::dispatchAfterResponse($request->all());
    }

    private function validateBody(): void
    {
        $signature = $this->request->header('X-Uber-Signature');
        $body = hash_hmac('sha256', $this->request->getContent(), config('ubereats.client_secret'));

        if (! hash_equals($signature, $body)) {
            throw new Exception('error_invalid_signature', Response::HTTP_BAD_REQUEST);
        }
    }
}
