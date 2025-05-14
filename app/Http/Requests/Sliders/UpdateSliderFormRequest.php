<?php

namespace App\Http\Requests\Sliders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'third_title' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'link' => 'nullable|string|max:255',
            'link_text' => 'nullable|string|max:255',
            'base_price' => 'nullable|numeric',
            'discount_price' => 'nullable|numeric',
            'slider_type' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'priority' => 'nullable|numeric',
        ];
    }
}
