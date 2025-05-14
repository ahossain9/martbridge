<?php

namespace App\Http\Controllers\Admin\Store;

use App\Constants\AdminConstant;
use App\Helpers\FileManageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\CreateBrandRequest;
use App\Http\Requests\Store\UpdateBrandRequest;
use App\Models\Brand;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BrandController extends Controller
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
        if (! $this->user->can('brand read')) {
            return redirect()->route('admin.unauthorized');
        }

        $brands = Brand::paginate(10);

        return view('admin.pages.store.brands.index', [
            'brands' => $brands,
        ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws Exception
     */
    public function store(CreateBrandRequest $request): RedirectResponse
    {
        if (! $this->user->can('brand create')) {
            return redirect()->route('admin.unauthorized');
        }

        $data = $request->validated();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['created_by'] = auth()->user()->email;

        $logo = $request->file('logo');

        if ($logo) {
            $relativePath = FileManageHelper::upload($logo, 'brands/'.Str::random(8));
            $data['logo'] = $relativePath;
        }
        $brand = Brand::create($data);

        if ($brand) {
            return back()->with('success', 'Brand created successfully');
        }

        return back()->with('error', 'Brand creation failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        if (! $this->user->can('brand create')) {
            return redirect()->route('admin.unauthorized');
        }

        return view('admin.pages.store.brands.edit', [
            'brand' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Exception
     */
    public function update(UpdateBrandRequest $request, Brand $brand): RedirectResponse
    {
        if (! $this->user->can('brand create')) {
            return redirect()->route('admin.unauthorized');
        }

        $data = $request->validated();

        $data['updated_by'] = auth()->user()->email;

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $logo = $request->file('logo');

        if ($logo) {
            $relativePath = FileManageHelper::upload($logo, 'brands/'.Str::random(8));
            if ($brand->logo) {
                FileManageHelper::delete($brand->logo);
            }
            $data['logo'] = $relativePath;
        }

        $brand->update($data);

        return back()->with('success', 'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        if (! $this->user->can('brand delete')) {
            return redirect()->route('admin.unauthorized');
        }

        try {
            if ($brand->logo) {
                FileManageHelper::delete($brand->logo);
            }

            return back()->with('success', 'Brand deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Brand deletion failed');
        }
    }
}
