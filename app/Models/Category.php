<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['slug', 'name', 'parent_id', 'sort_order'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order')->orderBy('name');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id')->orderBy('sort_order')->orderBy('name');
    }
}
