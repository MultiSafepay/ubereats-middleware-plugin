<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Menu;

use UbereatsModels\Login\Scope;
use UbereatsPlugin\Ubereats\ApiRequest;

class Api
{
    private ApiRequest $api;

    public function __construct()
    {
        $this->api = ApiRequest::v2(Scope::store);
    }

    /**
     * @param string $storeId
     * @param array<string, array<string>>|array<string, string> $data
     */
    public function upload(string $storeId, array $data): void
    {
        $this->api->send('PUT', "stores/$storeId/menus", $data);
    }
}
