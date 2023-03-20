<?php

declare(strict_types=1);

namespace UbereatsPlugin\Api;

use Exception;
use Illuminate\Support\Facades\Http;

class ApiRequest
{
    private const VENDOR = 'ubereats';
    private string $url;

    public function __construct()
    {
        $this->url = config('ubereats.backend_api.url');
    }

    /**
     * @param string $action
     * @param array<string, array<string>>|array<string, string> $data
     * @return array<string, array<string>>|array<string, string>
     */
    public function webhook(string $action, array $data): string|array
    {
        return $this->post('middleware/webhook', $action, $data);
    }

    /**
     * @param string $action
     * @param array<string, array<string>>|array<string, string> $data
     * @return array<string, array<string>>|array<string, string>
     */
    public function confirm(string $action, array $data): string|array
    {
        return $this->post('middleware/confirm', $action, $data);
    }

    /**
     * @param string $path
     * @param string $action
     * @param array<string, array<string>>|array<string, string> $data
     * @return array<string, array<string>>|array<string, string>
     */
    private function post(string $path, string $action, array $data): array|null
    {
        $data['vendor'] = self::VENDOR;
        $data['action'] = $action;

        $response = Http::post($this->url.$path, $data);

        if ($response->successful()) {
            return $response->json();
        }

        $message = "Error requesting backend api, path: $path, data: ".print_r($data, true);
        $message .= PHP_EOL.' Response: '.print_r($response->json(), true);

        throw new Exception($message);
    }
}
