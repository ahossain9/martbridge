<?php

namespace App\Http\Requests\Products\Labels;

use Illuminate\Foundation\Http\FormRequest;

class ProductLabelCreateFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:60|unique:product_labels',
            'is_active' => 'nullable',
            'extra' => 'nullable|string',
        ];
    }
}
