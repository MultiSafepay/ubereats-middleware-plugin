<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Store;

use Illuminate\Support\Collection;
use UbereatsModels\Login\Scope;
use UbereatsModels\Store\Store;
use UbereatsModels\Store\Integration;
use UbereatsPlugin\Ubereats\ApiRequest;
use Exception;

class Api
{
    private ApiRequest $api;

    public function __construct()
    {
        $this->api = ApiRequest::v1(Scope::store);
    }

    /** @return Collection<\UbereatsModels\Store\Store> */
    public function get(): Collection
    {
        $data = $this->api->send('GET', 'stores');

        return Store::collection($data);
    }

    public function getDetails(string $storeId): Store
    {
        $data = $this->api->send('GET', "stores/$storeId");

        return new Store($data);
    }

    public function getIntegrationDetails(string $storeId): Integration
    {
        $data = $this->api->send('GET', "stores/$storeId/pos_data");

        return new Integration($data);
    }

    public function activateIntegration(string $storeId): void
    {
        $data = $this->api->send('POST', "stores/$storeId/pos_data");

        if (is_string($data)) {
            throw new Exception($data);
        }
    }
}
