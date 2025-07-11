<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getProductTitleAttribute(): string
    {
        return $this->product->title;
    }

    public function getTotalSumAttribute(): float
    {
        return $this->qty * $this->product->price;
    }

    public function getProductImageUrlAttribute(): string
    {
        return $this->product->preview_image_url ?? '';
    }

}
