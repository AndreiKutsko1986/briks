<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'hex_code', 'sort_order'];

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'item_colors')->withPivot('image_path');
    }
}
