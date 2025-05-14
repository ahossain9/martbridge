<?php

namespace App\Http\Controllers\Admin\Product;

use App\Constants\AdminConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\Labels\ProductLabelCreateFormRequest;
use App\Http\Requests\Products\Labels\ProductLabelUpdateFormRequest;
use App\Models\ProductLabel;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProductLabelController extends Controller
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productLabelsCount = ProductLabel::count();
        $labels = ProductLabel::paginate(20);

        return view('admin.pages.products.labels.index', [
            'labels' => $labels,
            'productLabelsCount' => $productLabelsCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductLabelCreateFormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['created_by'] = $this->user->email;

        try {
            ProductLabel::create($data);

            return redirect()->back()->with('success', 'Label created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductLabelUpdateFormRequest $request, ProductLabel $label): RedirectResponse
    {
        $data = $request->validated();

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $data['updated_by'] = $this->user->email;

        try {
            $label->update($data);

            return redirect()->back()->with('success', 'Label updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            ProductLabel::find($id)->delete();

            return redirect()->back()->with('success', 'Label deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
