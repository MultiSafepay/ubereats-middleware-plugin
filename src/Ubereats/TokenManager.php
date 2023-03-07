<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use UbereatsModels\Login\GrantType;
use UbereatsModels\Login\Login;
use UbereatsModels\Login\Scope;
use Exception;

class TokenManager
{
    private const CACHE_KEY = 'ubereats_token';
    private const URL = 'https://login.uber.com/oauth/v2/token';

    private GrantType $grantType;
    private Login $model;

    public function __construct(
        private string $clientSecret,
        private string $clientId,
        private Scope $scope,
    )
    {
        $this->grantType = ($scope != Scope::pos_provisioning) ?
            GrantType::client_credentials
            : GrantType::authorization_code;
    }

    public function getToken(): string
    {
        $this->setFromCache();

        if (empty($this->model) || empty($this->model->access_token)) {
            $this->login();
        }

        return $this->model->access_token;
    }

    private function setFromCache(): void
    {
        $data = Cache::get(self::CACHE_KEY);

        if (empty($data)) {
            return;
        }

        $this->model = new Login($data);
    }

    private function login(): void
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $data = [
            'client_secret' => $this->clientSecret,
            'client_id' => $this->clientId,
            'grant_type' => $this->grantType->value,
            'scope' => $this->scope->value,
        ];

        $response = Http::withHeaders($headers)->post(self::URL, $data)->throw()->json();

        if (empty($response['access_token'])) {
            throw new Exception('error_login_on_ubereats');
        }

        $ttl = Carbon::now()->addSeconds($response['expires_in'] - 30);

        Cache::put(self::CACHE_KEY, $response, $ttl);

        $this->model = new Login($response);
    }
}
