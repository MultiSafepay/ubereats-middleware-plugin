<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Store;

use Illuminate\Support\Collection;
use UbereatsModels\Login\Scope;
use UbereatsModels\Store\Store;
use UbereatsPlugin\Ubereats\ApiRequest;

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
}
