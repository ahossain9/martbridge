@extends('admin.layouts.master')

@section('admin-title', 'New|Product')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Add new product</h3>
                <p>Fill the required fields to create a new product.</p>
            </div>

            <div class="">
                <a class="btn btn-primary" href="{{ route('admin.product_manage.products.index') }}">Back</a>
            </div>
        </div>
        @include('admin.partials.message')

        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <product-component></product-component>
            </div>
        </div>
    </div>
@endsection

@section('admin-scripts')
    <script src="{{ asset('admin-assets/js/scripts/forms/form-validation.js') }}"></script>
@endsection
