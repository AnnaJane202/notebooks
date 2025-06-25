<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'product.title' => 'required|string|max:255',
            'product.description' => 'required|string',
            'product.content' => 'nullable|string',
            'product.price' => 'required|numeric',
            'product.old_price' => 'nullable|numeric',
            'product.qty' => 'required|integer',
            'product.category_id' => 'required|integer|exists:categories,id',

            'images' => 'nullable|array',
            'images.*' => 'required|file',
            'params' => 'nullable|array',
            'params.*.id' => 'required|integer|exists:params,id',
            'params.*.value' => 'nullable|string',
        ];
    }

    protected function passedValidation()
    {
        $validated = $this->validated();
        return $this->merge([//здесь мы результат валидации мержим в один массив
            'product' => $validated['product'],
            'params' => $validated['params'],
            'images' => $this->images ?? []
        ]);
    }
}
