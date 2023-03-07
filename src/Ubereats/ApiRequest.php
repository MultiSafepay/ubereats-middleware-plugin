<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats;

use Illuminate\Support\Facades\Http;
use UbereatsModels\Login\Scope;

class ApiRequest
{
    private const BASE_URL = 'https://api.uber.com';
    private string $url;
    private TokenManager $tokenManager;

    public static function v1(Scope $scope) : self
    {
        return new self('/v1/eats/', $scope);
    }

    public static function v2(Scope $scope) : self
    {
        return new self('/v2/eats/', $scope);
    }

    public function __construct(string $version, Scope $scope)
    {
        $this->url = self::BASE_URL.$version;
        $this->tokenManager = new TokenManager(config('ubereats.ubereats_api.client_secret'), config('ubereats.ubereats_api.client_id'), $scope);
    }

    /**
     * @param string $method
     * @param string $path
     * @param null|array<string, array<string>>|array<string, string>|array<string, string> $data
     * @return array<string, array<string>>|array<string, string>|array<string, string>
     */
    public function send(string $method, string $path, null|array $data = null): string|array
    {
        return Http::withToken($this->tokenManager->getToken())->$method($this->url.$path, $data)->throw()->json();
    }
}
