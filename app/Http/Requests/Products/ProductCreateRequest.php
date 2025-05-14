<?php

namespace App\Http\Requests\Products;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ProductCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'vendor_id' => 'required|exists:vendors,id',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:product_categories,id',
            'sub_category_id' => 'required|exists:product_sub_categories,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'promo_price' => 'required|numeric',
            'moq' => 'required|numeric',
            'stock' => 'required|numeric',
            'sku' => 'nullable|string',
            'is_featured' => 'required',
            'is_trending' => 'required',
            'is_active' => 'required',
            'feature_image' => 'required',
            'images' => 'nullable|array',
            'labels' => 'nullable',
            'condition' => 'nullable:string',
            'attributes' => 'nullable|array',
            'attributes.*.name' => 'nullable|string',
            'attributes.*.input_type' => 'nullable|string',
            'attributes.*.values' => 'nullable|string',
            'is_advance_payment' => 'nullable',
            'advance_amount' => 'nullable|numeric',
            'variant_options' => 'nullable|string',
            'variant_combinations' => 'nullable|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'success' => false,
            'message' => 'Validation Error.',
            'data' => $validator->errors(),
        ], 422));
    }
}
