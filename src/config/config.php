<?php

declare(strict_types=1);

use UbereatsPlugin\Api\TokenManager;
use UbereatsPlugin\Api\ApiRequest;

return [
    'backend_api' => [
        'token_manager_class' => TokenManager::class,
        'api_handler_class' => ApiRequest::class,
        'login_url' => env('BACKEND_LOGIN_URL'),
        'refresh_url' => env('BACKEND_REFRESH_URL'),
        'username' => env('BACKEND_USERNAME'),
        'password' => env('BACKEND_PASSWORD'),
    ],
    'ubereats_api' => [
        'url' => env('UBEREATS_URL'),
        'client_secret' => env('UBEREATS_CLIENT_SECRET'),
        'client_id' => env('UBEREATS_CLIENT_ID'),
        'test_store' => env('UBEREATS_TEST_STORE'),
    ],
];
