<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Store;

use UbereatsPlugin\Ubereats\ApiRequest;
use UbereatsPlugin\Ubereats\Enum\Scope;
use UbereatsPlugin\Ubereats\Models\Store;
use Illuminate\Support\Collection;

class Api
{
    private ApiRequest $api;

    public function __construct()
    {
        $this->api = ApiRequest::v1(Scope::store);
    }

    /** @return Collection<\UbereatsPlugin\Ubereats\Models\Store> */
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
