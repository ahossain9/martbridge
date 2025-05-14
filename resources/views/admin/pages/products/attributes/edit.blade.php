
@extends('admin.layouts.master')

@section('admin-title', 'Edit|Attribute Values')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Edit attribute - <span class="badge badge-light-primary">{{ $attribute->name }}</span></h3>
                <p>Each attribute has many values.</p>
            </div>

            <div class="">
                <a class="btn-sm btn-prev" href="{{ url()->previous() }}"><i data-feather='arrow-left' class="font-large-1"></i></a>
            </div>
        </div>
        @include('admin.partials.message')

        <!-- Variant Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <form class="row" method="POST" action="{{ route('admin.product_manage.attributes.update', $attribute) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-12 mb-1">
                        <label class="form-label" for="product_category_id">
                            <strong>Chose Product Sub Category</strong>
                        </label>
                        <select class="form-select" id="subcategory_id" name="subcategory_id" required>
                            <option value="">Choose product subcategory</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}"
                                    {{ $attribute->product_sub_category_id == $subcategory->id ? 'selected' : '' }}
                                >{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-1">
                        <label class="form-label" for="name"><strong>Attribute Name</strong></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Size" autofocus data-msg="Please enter Variant" value="{{ $attribute->name }}" required />
                    </div>

                    <attribute-values :attribute_id="{{ $attribute->id }}"></attribute-values>

                    <div class="col-12">
                        <button type="submit" id="{{$attribute->id}}" class="btn btn-primary mt-2 me-1">Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




{{--<div class="modal fade" id="editProductVariantModal-{{$variant->id}}" tabindex="-1" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog modal-lg">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header bg-transparent">--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--            </div>--}}
{{--            <div class="modal-body px-sm-5 pb-5">--}}
{{--                <div class="text-center mb-2">--}}
{{--                    <h1 class="mb-1">Edit variant </h1>--}}
{{--                    <p>You can add more attributes to the subcategory.</p>--}}
{{--                </div>--}}
{{--                <form id="editFormProductVariantModal-{{$variant->id}}" class="row" method="POST" action="{{ route('admin.product_manage.attributes.update', $variant->id) }}">--}}
{{--                    @csrf--}}
{{--                    @method('PUT')--}}
{{--                    <div class="col-12">--}}
{{--                        <label class="form-label" for="product_category_id">--}}
{{--                            <strong>Chose Product Sub Category</strong>--}}
{{--                        </label>--}}
{{--                        <select class="form-select" id="subcategory_id" name="subcategory_id" required>--}}
{{--                            <option value="">Choose product subcategory</option>--}}
{{--                            @foreach($subcategories as $subcategory)--}}
{{--                                <option value="{{ $subcategory->id }}"--}}
{{--                                {{ $variant->product_sub_category_id == $subcategory->id ? 'selected' : '' }}--}}
{{--                                >{{ $subcategory->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-12">--}}
{{--                        <label class="form-label" for="name">Variant Name</label>--}}
{{--                        <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Size" autofocus data-msg="Please enter Variant" value="{{ $variant->name }}" required />--}}
{{--                    </div>--}}
{{--                    <div class="col-12 text-center">--}}
{{--                        <button type="submit" id="{{$variant->id}}" class="btn btn-primary mt-2 me-1">Update </button>--}}
{{--                        <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                            Discard--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
