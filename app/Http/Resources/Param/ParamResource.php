<?php

namespace App\Http\Resources\Param;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParamResource extends JsonResource
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
            'filter_type' => $this->filter_type,
            'filter_type_title' => $this->filter_type_title,
            'label' => $this->label,
            'param_groups_id' => $this->param_groups_id,
            'unit' => $this->unit,
        ];
    }
}
