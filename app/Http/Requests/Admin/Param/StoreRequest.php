<?php

namespace App\Http\Requests\Admin\Param;

use App\Enums\Param\ParamFilterTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'filter_type' => 'required|integer|in:' . ParamFilterTypeEnum::valuesAsString(),
            'label' => 'required|integer',
            'param_groups_id' => 'required|integer|exists:param_groups,id',
            'unit' => 'nullable|string',
        ];
    }
}
