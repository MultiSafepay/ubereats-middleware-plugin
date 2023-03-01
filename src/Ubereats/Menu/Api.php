<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Menu;

use UbereatsPlugin\Ubereats\ApiRequest;
use UbereatsPlugin\Ubereats\Enum\Scope;

class Api
{
    private ApiRequest $api;

    public function __construct()
    {
        $this->api = ApiRequest::v2(Scope::store);
    }

    /**
     * @param string $storeId
     * @param array<string, array<string>> $data
     */
    public function upload(string $storeId, array $data): void
    {
        $this->api->send('PUT', "stores/$storeId/menus", $data);
    }
}
