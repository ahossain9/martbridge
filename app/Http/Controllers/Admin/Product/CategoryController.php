<?php

namespace App\Http\Controllers\Admin\Product;

use App\Constants\AdminConstant;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
        if (! $this->user->can('category read')) {
            return redirect()->route('admin.unauthorized');
        }

        $productCategories = ProductCategory::paginate(10);

        return view('admin.pages.products.categories.index', [
            'productCategories' => $productCategories,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (! $this->user->can('category create')) {
            return redirect()->route('admin.unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:60|unique:product_categories',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['created_by'] = auth()->user()->email;

        try {
            ProductCategory::create($validated);

            return redirect()->back()->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        if (! $this->user->can('category create')) {
            return redirect()->route('admin.unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:60|unique:product_categories,name,'.$id,
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['updated_by'] = \auth()->user()->email;

        try {
            ProductCategory::find($id)->update($validated);

            return redirect()->back()->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        if (! $this->user->can('category delete')) {
            return redirect()->route('admin.unauthorized');
        }

        try {
            ProductCategory::find($id)->delete();

            return redirect()->back()->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
