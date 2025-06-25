<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ParamProduct extends Model
{
    protected $table = 'param_product';

    public function param(): BelongsToMany
    {
        return $this->belongsToMany(Param::class);
    }

    public function getTitleAttribute(): string
    {
        return $this->param->title;
    }
}
