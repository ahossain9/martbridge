@extends('admin.layouts.master')

@section('admin-title', 'Edit Slider')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Slider - <span class="badge bg-primary">{{ $slider->name }}</span></h3>
            </div>

            <div class="">
                <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
        @include('admin.partials.message')

        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <form method="POST" action="{{ route('admin.sliders.update', $slider) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label class="form-label" for="name"><strong>Name *</strong></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Laptop sale" autofocus data-msg="Please enter slider name" value="{{ $slider->name }}" />
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="title"><strong>Title</strong></label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Ex: Trade-In Offer" autofocus data-msg="Please enter slider title" value="{{ $slider->title }}" />
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="subtitle"><strong>Sub Title (Bold)</strong></label>
                            <input type="text" id="subtitle" name="subtitle" class="form-control" placeholder="Ex: Mac Book Air Latest Model" autofocus data-msg="Please enter Slider Subtitle" value="{{ $slider->subtitle }}" />
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="third_title"><strong>Third Title (left of price)</strong></label>
                            <input type="text" id="third_title" name="third_title" class="form-control" placeholder="Ex: From"  value="{{ $slider->third_title }}" />
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="base_price"><strong>Base Price</strong></label>
                            <input type="number" step="0.01" id="base_price" name="base_price" class="form-control" placeholder="Ex: 9000" value="{{ $slider->base_price }}"/>
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="discount_price"><strong>Discount Price</strong></label>
                            <input type="number" step="0.01" id="discount_price" name="discount_price" class="form-control" placeholder="Ex: 7999.99" value="{{ $slider->discount_price }}"/>
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="link"><strong>Link</strong></label>
                            <input type="text" id="link" name="link" class="form-control" placeholder="Ex: https://example.com/products/mac-book-air" value="{{ $slider->link }}" />
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="link_text"><strong>Link Text</strong></label>
                            <input type="text" id="link_text" name="link_text" class="form-control" placeholder="Ex: Shop Now" value="{{ $slider->link_text }}" />
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="product_category_id">
                                <strong>Slider Type *</strong>
                            </label>
                            <select class="form-select" id="slider_type_id" name="slider_type" required>
                                <option value="">Choose slider type</option>
                                <option value="home" {{ $slider->slider_type == 'home' ? 'selected' : '' }}>Slider</option>
                                <option value="banner" {{ $slider->slider_type == 'banner' ? 'selected' : '' }}>Banner</option>
                                <option value="trending" {{ $slider->slider_type == 'trending' ? 'selected' : '' }}>Trending</option>
                            </select>
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="slider_type"><strong>Slider Image (1920x440) *</strong></label>
                        </div>

                        @if($slider->image)
                            <div class="col-md-12">
                                <img src="{{ \App\Helpers\FileManageHelper::getS3FileUrl($slider->image) }}" alt="{{ $slider->name }} Image" width="600" height="120">
                            </div>
                        @endif

                        <file-uploader> </file-uploader>

                        <div class="col-12 mt-1 mb-1">
                            <label class="form-label" for="priority"><strong>Slider Priority *</strong></label>
                            <input type="text" id="priority" name="priority" class="form-control" placeholder="2" value="{{ $slider->priority }}" required/>
                        </div>

                        <div class="col-12 mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                       name="status" tabindex="3" {{ $slider->status == 1 ? 'checked' : '' }} />
                                <label class="form-check-label" for="status"> Active </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Update </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin-scripts')
    <script src="{{ asset('admin-assets/js/scripts/forms/form-validation.js') }}"></script>
@endsection
