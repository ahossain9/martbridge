<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Helpers\FileManageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\VendorCreateRequest;
use App\Http\Requests\Store\VendorUpdateRequest;
use App\Models\Vendor;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::paginate(10);

        return view('admin.pages.vendors.index', [
            'vendors' => $vendors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.pages.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws Exception
     */
    public function store(VendorCreateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $logo = $request->file('logo');
        $banner = $request->file('banner');
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($logo) {
            $data['logo'] = FileManageHelper::upload($logo, 'vendors/logo/'.$data['name'].'/'.Str::random(8));
        }

        if ($banner) {
            $data['banner'] = FileManageHelper::upload($logo, 'vendors/banner/'.$data['name'].'/'.Str::random(8));
        }
        $data['created_by'] = auth()->user()->email;

        $vendor = Vendor::create($data);
        if (! $vendor) {
            return back()->with('error', 'Unable to create vendor');
        }

        return back()->with('success', 'Vendor created successfully');
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
    public function edit(Vendor $vendor): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.pages.vendors.edit', [
            'vendor' => $vendor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Exception
     */
    public function update(VendorUpdateRequest $request, Vendor $vendor)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->email;

        $logo = $request->file('logo') ?? null;
        $banner = $request->file('banner') ?? null;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($logo) {
            if ($vendor->logo) {
                FileManageHelper::delete($vendor->logo);
            }
            $data['logo'] = FileManageHelper::upload($logo, 'vendors/logo/'.$data['name'].'/'.Str::random(8));
        }

        if ($banner) {
            if ($vendor->banner) {
                FileManageHelper::delete($vendor->banner);
            }
            $data['banner'] = FileManageHelper::upload($logo, 'vendors/banner/'.$data['name'].'/'.Str::random(8));
        }

        $vendor->update($data);

        return back()->with('success', 'Vendor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        if ($vendor->logo) {
            FileManageHelper::delete($vendor->logo);
        }

        if ($vendor->banner) {
            FileManageHelper::delete($vendor->banner);
        }

        $vendor->delete();

        return back()->with('success', 'Vendor deleted successfully');
    }
}
