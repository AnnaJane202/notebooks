<?php

namespace App\Http\Resources\ParamGroup;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParamGroupResource extends JsonResource
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
        ];
    }
}
