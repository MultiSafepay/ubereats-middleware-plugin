<?php

declare(strict_types=1);

namespace UbereatsPlugin\Api;

use Illuminate\Support\Facades\Http;

class ApiRequest
{
    private const VENDOR = 'ubereats';
    private string $url;
    private TokenManager $tokenManager;

    public function __construct()
    {
        $this->url = config('ubereats.backend_api.url');
        $this->tokenManager = new TokenManager();
    }

    /**
     * @param string $action
     * @param array<string, array<string>>|array<string, string> $data
     * @return array<string, array<string>>|array<string, string>
     */
    public function webhook(string $action, array $data): string|array
    {
        return $this->post('/middleware/webhook', $action, $data);
    }

    /**
     * @param string $action
     * @param array<string, array<string>>|array<string, string> $data
     * @return array<string, array<string>>|array<string, string>
     */
    public function confirm(string $action, array $data): string|array
    {
        return $this->post('/middleware/confirm', $action, $data);
    }

    /**
     * @param string $path
     * @param string $action
     * @param array<string, array<string>>|array<string, string> $data
     * @return array<string, array<string>>|array<string, string>
     */
    private function post(string $path, string $action, array $data): array
    {
        $data['vendor'] = self::VENDOR;
        $data['action'] = $action;

        return Http::withToken($this->tokenManager->getToken())->post($this->url.$path, $data)->throw()->json();
    }
}
