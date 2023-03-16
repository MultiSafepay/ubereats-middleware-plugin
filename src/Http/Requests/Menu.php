<?php

declare(strict_types=1);

namespace UbereatsPlugin\Http\Requests;

class Menu extends Request
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'storeId' => 'required|uuid',
            'menus' => 'required|array',
        ];
    }
}
