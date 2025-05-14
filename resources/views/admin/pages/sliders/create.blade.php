@extends('admin.layouts.master')

@section('admin-title', 'Create Slider')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>New Slider</h3>
            </div>

            <div class="">
                <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
        @include('admin.partials.message')

        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label class="form-label" for="name"><strong>Name *</strong></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Laptop sale" autofocus data-msg="Please enter slider name" required />
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="title"><strong>Title </strong></label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Ex: Trade-In Offer" autofocus data-msg="Please enter slider title" />
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="subtitle"><strong>Sub Title (Bold) </strong></label>
                            <input type="text" id="subtitle" name="subtitle" class="form-control" placeholder="Ex: Mac Book Air Latest Model" autofocus data-msg="Please enter Slider Subtitle" />
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="third_title"><strong>Third Title (left of price) </strong></label>
                            <input type="text" id="third_title" name="third_title" class="form-control" placeholder="Ex: From" />
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="base_price"><strong>Base Price </strong></label>
                            <input type="number" step="0.01" id="base_price" name="base_price" class="form-control" placeholder="Ex: 9000"/>
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="discount_price"><strong>Sale Price </strong></label>
                            <input type="number" step="0.01" id="discount_price" name="discount_price" class="form-control" placeholder="Ex: 7999.99"/>
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="link"><strong>Link </strong></label>
                            <input type="text" id="link" name="link" class="form-control" placeholder="Ex: https://example.com/products/mac-book-air"/>
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="link_text"><strong>Link Text </strong></label>
                            <input type="text" id="link_text" name="link_text" class="form-control" placeholder="Ex: Shop Now"/>
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="product_category_id">
                                <strong>Slider Type *</strong>
                            </label>
                            <select class="form-select" id="slider_type_id" name="slider_type" required>
                                <option value="">Choose slider type</option>
                                <option value="home" selected>Slider</option>
                                <option value="banner">Banner</option>
                                <option value="trending">Trending</option>
                            </select>

{{--                            <label class="form-label" for="slider_type"><strong>Slider Type *</strong></label>--}}
{{--                            <input type="text" id="slider_type" name="slider_type" class="form-control" placeholder="Ex: Shop Now" value="home" required/>--}}
                        </div>

                        <div class="col-12 mb-1">
                            <label class="form-label" for="slider_type"><strong>Slider Image (1920x440) *</strong></label>
                        </div>

                        <file-uploader> </file-uploader>

                        <div class="col-12 mt-1 mb-1">
                            <label class="form-label" for="priority"><strong>Slider Priority *</strong></label>
                            <input type="text" id="priority" name="priority" class="form-control" placeholder="2" required/>
                        </div>

                        <div class="col-12 mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                       name="status" tabindex="3" checked />
                                <label class="form-check-label" for="status"> Active </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Create </button>
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
