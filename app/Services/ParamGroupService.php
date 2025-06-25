<?php

namespace App\Services;

use App\Models\ParamGroup;


class ParamGroupService
{
    public static function store(array $data): ParamGroup
    {
        return ParamGroup::create($data);
    }

    public static function update(ParamGroup $paramGroup, array $data): ParamGroup
    {
        $paramGroup->update($data);
        return $paramGroup->fresh();
    }
}
