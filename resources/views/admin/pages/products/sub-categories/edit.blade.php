@extends('admin.layouts.master')

@section('admin-title', 'Edit Subcategory')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Update Subcategory - <span class="badge bg-primary">{{ $subcategory->name }}</span></h3>
            </div>

            <div class="">
                <a class="btn btn-primary" href="{{ route('admin.product_manage.sub_categories.index') }}">Back</a>
            </div>
        </div>
        @include('admin.partials.message')

        <div class="card">
            <div class="card-body">
                <form class="row" method="POST" action="{{ route('admin.product_manage.sub_categories.update', $subcategory) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label class="form-label" for="product_category_id">
                            <strong>Chose Product Category</strong>
                        </label>
                        <select class="form-select" id="product_category_id" name="product_category_id" required>
                            <option value="">Choose product category</option>
                            @foreach($productCategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $subcategory->product_category_id ? 'selected' : '' }}
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-1">
                        <label class="form-label" for="name">Sub Category Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Sub Category Name" autofocus data-msg="Please enter sub category name"
                               value="{{ $subcategory->name }}"
                               required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="image"><strong>Logo </strong></label>
                        <input type="file" id="image" name="image" class="form-control" />

                        @if($subcategory->image)
                            <div class="mt-2 mb-2">
                                <img loading="lazy" src="{{ \App\Helpers\FileManageHelper::getS3FileUrl($subcategory->image) }}" alt="{{ $subcategory->name }}" width="300">
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_shown_to_home_page"
                                   name="is_shown_to_home_page" tabindex="3" {{ $subcategory->is_shown_to_home_page ? 'checked' : '' }} />
                            <label class="form-check-label" for="is_shown_to_home_page"> Show On Home Page </label>
                        </div>
                    </div>

                    <div class="col-12 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active"
                                   name="is_active" tabindex="3" {{ $subcategory->is_active ? 'checked' : '' }} />
                            <label class="form-check-label" for="is_active"> Active </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
