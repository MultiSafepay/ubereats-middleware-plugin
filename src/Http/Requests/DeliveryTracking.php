<?php

declare(strict_types=1);

namespace UbereatsPlugin\Http\Requests;

class DeliveryTracking extends Request
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'order' => 'required|uuid',
            'restaurant' => 'required|uuid',
            'latitude' => 'required|float',
            'longitude' => 'required|float',
            'time' => 'required|date'
        ];
    }
}
