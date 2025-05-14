<?php

namespace App\Http\Controllers\Admin\Sliders;

use App\Constants\AdminConstant;
use App\Helpers\FileManageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sliders\CreateSliderFormRequest;
use App\Http\Requests\Sliders\UpdateSliderFormRequest;
use App\Models\Slider;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SliderController extends Controller
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
        if (! $this->user->can('home slider read')) {
            return redirect()->route('admin.unauthorized');
        }

        $sliders = Slider::paginate(10);

        return view('admin.pages.sliders.index', [
            'sliders' => $sliders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! $this->user->can('home slider create')) {
            return redirect()->route('admin.unauthorized');
        }

        return view('admin.pages.sliders.create');
    }

    public function store(CreateSliderFormRequest $request)
    {
        if (! $this->user->can('home slider create')) {
            return redirect()->route('admin.unauthorized');
        }

        $data = $request->validated();
        $image = $request->file('image');
        if ($image) {
            $relative_path = FileManageHelper::upload($image, 'images/sliders/'.Str::random(8));

            $data['image'] = $relative_path;
        }

        $data['status'] = $request->status === 'on' ? 1 : 0;
        $data['created_by'] = auth()->user()->email;

        $slider = Slider::create($data);

        if ($slider) {
            return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully');
        }

        return redirect()->back()->with('error', 'Unable to create slider');
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
    public function edit(Slider $slider)
    {
        if (! $this->user->can('home slider create')) {
            return redirect()->route('admin.unauthorized');
        }

        return view('admin.pages.sliders.edit', [
            'slider' => $slider,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Exception
     */
    public function update(UpdateSliderFormRequest $request, Slider $slider): RedirectResponse
    {
        if (! $this->user->can('home slider create')) {
            return redirect()->route('admin.unauthorized');
        }

        $data = $request->validated();

        $image = $request->file('image');
        if ($image) {
            $relative_path = FileManageHelper::upload($request->file('image'), 'images/sliders/'.Str::random(8));
            if ($slider->image) {
                FileManageHelper::delete($slider->image);
            }
            $data['image'] = $relative_path;
        }

        $data['status'] = $request->status === 'on' ? 1 : 0;
        $data['updated_by'] = auth()->user()->email;

        if ($slider->update($data)) {
            return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully');
        }

        return redirect()->back()->with('error', 'Unable to update slider');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        if (! $this->user->can('home slider delete')) {
            return redirect()->route('admin.unauthorized');
        }

        if ($slider->delete()) {
            if ($slider->image) {
                FileManageHelper::delete($slider->image);
            }

            return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully');
        }

        return redirect()->back()->with('error', 'Unable to delete slider');
    }
}
