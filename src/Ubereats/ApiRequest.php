<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats;

use Exception;
use Illuminate\Support\Facades\Http;
use UbereatsModels\Login\GrantType;
use UbereatsModels\Login\Scope;

class ApiRequest
{
    private const BASE_URL = 'https://api.uber.com';
    private string $url;
    private TokenManager $tokenManager;

    public static function v1(Scope $scope, GrantType $grantType = GrantType::client_credentials) : self
    {
        return new self('/v1/eats/', $scope, $grantType);
    }

    public static function v2(Scope $scope, GrantType $grantType = GrantType::client_credentials) : self
    {
        return new self('/v2/eats/', $scope, $grantType);
    }

    public function __construct(string $version, Scope $scope, GrantType $grantType)
    {
        $this->url = self::BASE_URL.$version;
        $this->tokenManager = new TokenManager(
            config('ubereats.ubereats_api.client_secret'),
            config('ubereats.ubereats_api.client_id'),
            $scope,
            $grantType
        );
    }

    /**
     * @param string $method
     * @param string $path
     * @param null|array<string, array<string>>|array<string, string>|array<string, string> $data
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public function send(string $method, string $path, null|array $data = null): string|array
    {
        $response = Http::withToken($this->tokenManager->getToken())->$method($this->url.$path, $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new Exception("Error requesting ubereats, method: $method, path: $path, data: ".print_r($data, true).$response->json());
    }
}
