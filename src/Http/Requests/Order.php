<?php

declare(strict_types=1);

namespace UbereatsPlugin\Http\Requests;

class Order extends Request
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'orderId' => 'required|uuid',
            'id' => 'required|uuid',
        ];
    }
}
