<?php

declare(strict_types=1);

namespace UbereatsPlugin\Http\Controllers;

use UbereatsPlugin\Http\Requests\Menu as Request;
use UbereatsPlugin\Jobs\Menu as JobMenu;

class Menu extends Controller
{
    public function __invoke(Request $request): void
    {
        $data = $request->all();

        JobMenu::dispatch($data);
    }
}
