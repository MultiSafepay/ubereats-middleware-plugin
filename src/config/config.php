<?php

declare(strict_types=1);

use UbereatsPlugin\Api\TokenManager;
use UbereatsPlugin\Api\ApiRequest;

return [
    'backend_api' => [
        'token_manager_class' => TokenManager::class,
        'api_handler_class' => ApiRequest::class,
        'login_url' => getenv('BACKEND_LOGIN_URL'),
        'refresh_url' => getenv('BACKEND_REFRESH_URL'),
        'username' => getenv('BACKEND_USERNAME'),
        'password' => getenv('BACKEND_PASSWORD'),
    ],
    'ubereats_api' => [
        'url' => getenv('UBEREATS_URL'),
        'client_secret' => getenv('UBEREATS_CLIENT_SECRET'),
        'client_id' => getenv('UBEREATS_CLIENT_ID'),
    ],
];
