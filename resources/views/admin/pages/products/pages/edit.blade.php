@extends('admin.layouts.master')

@section('admin-title', 'Edit|Product')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Edit Product - <span class="badge bg-primary">{{ $product->name }}</span></h3>
            </div>

            <div class="">
                <a class="btn btn-primary" href="{{ route('admin.product_manage.products.index') }}">Back</a>
            </div>
        </div>
        @include('admin.partials.message')

        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <edit-product :product_id="{{ $product->id }}"></edit-product>
            </div>
        </div>
    </div>
@endsection

@section('admin-scripts')
    <script src="{{ asset('admin-assets/js/scripts/forms/form-validation.js') }}"></script>
@endsection
