<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'variant_id' => 'required|exists:attributes,id',
            'option_values' => 'required|array|max:255|unique:variant_values,name,NULL,id,variant_id,'.request()->variant_id,
        ];
    }

    public function messages()
    {
        return [
            'option_values.unique' => 'Value already exists. Add another one.',
        ];
    }
}
