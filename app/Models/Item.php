<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    protected $fillable = [
        'item_no', 'category_id', 'name', 'description', 'weight_grams',
        'stud_dimensions', 'year_from', 'year_to', 'image_path', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'weight_grams' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'item_colors')->withPivot('image_path')->orderBy('sort_order');
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }

    public function activeListings(): HasMany
    {
        return $this->hasMany(Listing::class)->where('is_active', true);
    }

    public function imageUrl(): ?string
    {
        return $this->image_path ? Storage::disk('public')->url($this->image_path) : null;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('item_no', 'like', "%{$term}%")
                ->orWhere('name', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%");
        });
    }

    public function scopeInCategorySlug(Builder $query, string $slug): Builder
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            return $query;
        }

        $ids = Category::where('id', $category->id)
            ->orWhere('parent_id', $category->id)
            ->pluck('id');

        return $query->whereIn('category_id', $ids);
    }
}
