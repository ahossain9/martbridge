<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\ProductSubCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(): Factory|View|Application
    {
        $subcategories = ProductSubCategory::all();
        $attributes = Attribute::paginate(10);

        return view('admin.pages.products.attributes.index', [
            'subcategories' => $subcategories,
            'attributes' => $attributes,
        ]);
    }

    public function create()
    {
        $subcategories = ProductSubCategory::all();

        return view('admin.pages.products.attributes.create', [
            'subcategories' => $subcategories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_id' => 'required|exists:product_sub_categories,id',
            // name should be unique for each subcategory
            'name' => 'required|string|max:255|unique:attributes,name,NULL,id,product_sub_category_id,'.$request->subcategory_id,
        ]);

        $attribute = Attribute::create([
            'product_sub_category_id' => $validated['subcategory_id'],
            'name' => $validated['name'],
            'created_by' => auth('admin')->user()->email,
        ]);

        if ($attribute) {
            // validate variant options
            $validated = $request->validate([
                'attribute_values' => 'required|array|max:255|unique:attribute_values,name,NULL,id,attribute_id,'.$attribute->id,
            ]);
            foreach ($validated['attribute_values'] as $value) {
                $attribute->attribute_values()->create([
                    'name' => $value,
                    'created_by' => auth('admin')->user()->email,
                ]);
            }
        }

        return redirect()->route('admin.product_manage.attributes.index')->with('success', 'Attribute values created successfully.');
    }

    public function show($id)
    {

    }

    public function edit(Attribute $attribute)
    {
        $subcategories = ProductSubCategory::all();

        return view('admin.pages.products.attributes.edit', [
            'subcategories' => $subcategories,
            'attribute' => $attribute,
        ]);
    }

    public function update(Request $request, Attribute $attribute): RedirectResponse
    {
        $validated = $request->validate([
            'subcategory_id' => 'required|exists:product_sub_categories,id',
            'name' => 'required|string|max:255|unique:attributes,name,'.$attribute->id.',id,product_sub_category_id,'.$request->subcategory_id,
        ]);

        $attribute->update([
            'product_sub_category_id' => $validated['subcategory_id'],
            'name' => $validated['name'],
            'updated_by' => auth('admin')->user()->email,
        ]);

        // delete all option values
        // FIX: try with dynamically
        $attribute->attribute_values()->delete();

        $validated = $request->validate([
            // validate variant options
            'attribute_values' => 'required|array|max:255|unique:attribute_values,name,NULL,id,attribute_id,'.$attribute->id,
        ]);

        foreach ($validated['attribute_values'] as $value) {
            // update or create
            $attribute->attribute_values()->updateOrCreate([
                'name' => $value,
                'updated_by' => auth('admin')->user()->email,
            ]);
        }

        return redirect()->route('admin.product_manage.attributes.index')->with('success', 'Attribute values updated successfully.');
    }

    public function destroy(Attribute $attribute): RedirectResponse
    {
        $attribute->delete();

        return back()->with('success', 'Attribute values deleted successfully.');
    }
}
