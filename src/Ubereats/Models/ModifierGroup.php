<?php

declare(strict_types=1);

namespace UbereatsPlugin\Ubereats\Models;

use CastModels\Model;
use Illuminate\Support\Collection;

class ModifierGroup extends Model
{
    public string $id;
    public string $title;
    public string $external_data;
    /** \UbereatsPlugin\Ubereats\Models\Item */
    public Collection $selected_items;
    /** \UbereatsPlugin\Ubereats\Models\Item */
    public Collection $removed_items;
}
