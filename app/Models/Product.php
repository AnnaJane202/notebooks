<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(ProductObserver::class)]
class Product extends Model
{
    use HasFilter;

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function params(): BelongsToMany
    {
        return $this->belongsToMany(Param::class)->withPivot('value');
    }

    public function paramProducts(): HasMany
    {
        return $this->hasMany(ParamProduct::class, 'product_id', 'id');
    }

    public function getPreviewImageUrlAttribute(): null|string
    {
        return $this->images()->first()->url ?? null;
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class)->where('session_id', session()->getId());
//        return $this->hasOne(Cart::class);
    }
}
