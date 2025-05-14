@extends('admin.layouts.master')

@section('admin-title', 'Add|Variation Option')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Add new attribute</h3>
                <p>Each attribute has many values.</p>
            </div>

            <div class="">
                <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
        @include('admin.partials.message')

        <!-- Variant Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <form class="row" method="POST" action="{{ route('admin.product_manage.attributes.store') }}">
                    @csrf
                    <div class="col-12 mb-1">
                        <label class="form-label" for="product_category_id">
                            <strong>Choose Product Sub Category</strong>
                        </label>
                        <select class="form-select" id="subcategory_id" name="subcategory_id" required>
                            <option value="">Choose product subcategory</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-1">
                        <label class="form-label" for="name"><strong>Attribute Name</strong></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Size" autofocus data-msg="Please enter Variant" required />
                    </div>
                    <attribute-values :create_mode="true"></attribute-values>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Create </button>
                    </div>
                </form>
            </div>
        </div>
        <!--/ Variant Table -->

    </div>
@endsection






{{--<div class="modal fade" id="addProductVariantModal" tabindex="-1" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog modal-lg">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header bg-transparent">--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--            </div>--}}
{{--            <div class="modal-body px-sm-5 pb-5">--}}
{{--                <div class="text-center mb-2">--}}
{{--                    <h1 class="mb-1">Variant Option Name (Attribute) </h1>--}}
{{--                    <p>You can add more attributes to the subcategory.</p>--}}
{{--                </div>--}}
{{--                <form class="row" method="POST" action="{{ route('admin.product_manage.attributes.store') }}">--}}
{{--                    @csrf--}}
{{--                    <div class="col-12">--}}
{{--                        <label class="form-label" for="product_category_id">--}}
{{--                            <strong>Choose Product Sub Category</strong>--}}
{{--                        </label>--}}
{{--                        <select class="form-select" id="subcategory_id" name="subcategory_id" required>--}}
{{--                            <option value="">Choose product subcategory</option>--}}
{{--                            @foreach($subcategories as $subcategory)--}}
{{--                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-12">--}}
{{--                        <label class="form-label" for="name">Variant Name</label>--}}
{{--                        <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Size" autofocus data-msg="Please enter Variant" required />--}}
{{--                    </div>--}}
{{--                    <div class="col-12 text-center">--}}
{{--                        <button type="submit" class="btn btn-primary mt-2 me-1">Create </button>--}}
{{--                        <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                            Discard--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
