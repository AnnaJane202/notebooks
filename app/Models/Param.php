<?php

namespace App\Models;

use App\Enums\Param\ParamFilterTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Param extends Model
{
    public function getFilterTypeTitleAttribute(): string
    {
        return ParamFilterTypeEnum::map()[$this->filter_type];
    }

    public function paramProducts(): HasMany
    {
        return $this->hasMany(ParamProduct::class, 'param_id', 'id');
    }

    public function paramGroup(): BelongsTo
    {
        return $this->BelongsTo(ParamGroup::class, 'param_groups_id', 'id');

    }

    public function getParamGroupTitleAttribute(): string
    {

        return $this->paramGroup->title;
    }
}
