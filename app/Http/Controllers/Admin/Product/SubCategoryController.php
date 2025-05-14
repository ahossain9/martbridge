<?php

namespace App\Http\Controllers\Admin\Product;

use App\Constants\AdminConstant;
use App\Helpers\FileManageHelper;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public object $user;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard(AdminConstant::ADMIN_GUARD)->user();

            return $next($request);
        });
    }

    public function index()
    {
        if (! $this->user->can('sub category read')) {
            return redirect()->route('admin.unauthorized');
        }

        $product_sub_categories = ProductSubCategory::latest()->paginate(10);
        $product_categories = ProductCategory::all();

        return view('admin.pages.products.sub-categories.index', [
            'product_sub_categories' => $product_sub_categories,
            'product_categories' => $product_categories,
        ]);
    }

    public function store(Request $request)
    {
        if (! $this->user->can('sub category create')) {
            return redirect()->route('admin.unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:60|unique:product_sub_categories',
            'product_category_id' => 'required|integer|exists:product_categories,id',
            'is_active' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'is_shown_to_home_page' => 'nullable',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['is_shown_to_home_page'] = $request->has('is_shown_to_home_page') ? 1 : 0;
        $validated['created_by'] = \auth()->user()->email;

        $logo = $request->file('image');

        if ($logo) {
            $relativePath = FileManageHelper::upload($logo, 'subcategory/'.Str::random(8));
            $validated['image'] = $relativePath;
        }

        try {
            ProductSubCategory::create($validated);

            return redirect()->back()->with('success', 'Sub Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(ProductSubCategory $subCategory)
    {
        if (! $this->user->can('sub category create')) {
            return redirect()->route('admin.unauthorized');
        }
        $productCategories = ProductCategory::where('is_active', true)->get();

        return view('admin.pages.products.sub-categories.edit', [
            'subcategory' => $subCategory,
            'productCategories' => $productCategories,
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        if (! $this->user->can('sub category create')) {
            return redirect()->route('admin.unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:60|unique:product_sub_categories,name,'.$id,
            'product_category_id' => 'required|integer|exists:product_categories,id',
            'is_active' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'is_shown_to_home_page' => 'nullable',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['is_shown_to_home_page'] = $request->has('is_shown_to_home_page') ? 1 : 0;
        $validated['updated_by'] = \auth()->user()->email;

        $logo = $request->file('image');

        $subCategory = ProductSubCategory::findOrFail($id);

        if ($logo) {
            $relativePath = FileManageHelper::upload($logo, 'subcategory/'.Str::random(8));
            if ($subCategory->image) {
                FileManageHelper::delete($subCategory->image);
            }
            $validated['image'] = $relativePath;
        }

        try {
            $subCategory->update($validated);

            return redirect()->back()->with('success', 'Sub Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        if (! $this->user->can('sub category delete')) {
            return redirect()->route('admin.unauthorized');
        }

        $subcategory = ProductSubCategory::findOrFail($id);

        try {
            if ($subcategory->image) {
                FileManageHelper::delete($subcategory->image);
            }
            $subcategory->delete();

            return redirect()->back()->with('success', 'Sub Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
