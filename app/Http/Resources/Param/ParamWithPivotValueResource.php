<?php

namespace App\Http\Resources\Param;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParamWithPivotValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'value' => $this->getOriginal('pivot_value'),
            'param_group' => $this->param_group_title,
            'unit' => $this->unit,
        ];
    }
}
