<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\API\BaseController;
use App\Http\Requests\Admin\AttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttributeValueController extends BaseController
{
    public function index($attribute_id): JsonResponse
    {
        $variant_values = AttributeValue::where('attribute_id', $attribute_id)->get();

        return $this->sendResponse($variant_values, 'Variant Options retrieved successfully.');
    }

    public function create()
    {
        //
    }

    public function getAttributes($category_id): JsonResponse
    {
        $attributes = Attribute::where('product_sub_category_id', $category_id)->get();

        return response()->json([
            'success' => true,
            'attributes' => $attributes,
        ]);
    }

    public function store(AttributeValueRequest $request)
    {
        $validated = $request->validated();

        try {
            foreach ($validated['option_values'] as $option_value) {
                AttributeValue::create([
                    'attribute_id' => $validated['attribute_id'],
                    'name' => $option_value['value'],
                    'created_by' => auth('admin')->user()->email,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Attribute Values created successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed due to '.$e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        // delete variant option
        $variant_option = AttributeValue::find($id);
        $variant_option->delete();

        return response()->json([
            'success' => true,
            'message' => 'Variant Option deleted successfully.',
        ]);
    }
}
