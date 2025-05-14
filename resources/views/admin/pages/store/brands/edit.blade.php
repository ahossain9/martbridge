@extends('admin.layouts.master')

@section('admin-title', 'Edit Brand')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Update Brand - <span class="badge bg-primary">{{ $brand->name }}</span></h3>
            </div>

            <div class="">
                <a class="btn btn-primary" href="{{ route('admin.store.brands.index') }}">Back</a>
            </div>
        </div>
        @include('admin.partials.message')

        <div class="card">
            <div class="card-body">
                <form class="row" method="POST" action="{{ route('admin.store.brands.update', $brand) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12 mb-1">
                        <label class="form-label" for="name"><strong>Name *</strong></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Samsung" autofocus data-msg="Please enter brand name" value="{{ $brand->name }}" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="logo"><strong>Logo </strong></label>
                        <input type="file" id="logo" name="logo" class="form-control" />

                        @if($brand->logo)
                            <div class="mt-2 mb-2">
                                <img loading="lazy" src="{{ \App\Helpers\FileManageHelper::getS3FileUrl($brand->logo) }}" alt="{{ $brand->name }}" width="300">
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="description"><strong>About the brand (This will be visible to customers)</strong></label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="4">{{ $brand->description }}</textarea>
                    </div>

                    <div class="col-12 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="is_active" tabindex="3" {{ $brand->is_active ? 'checked' : '' }} />
                            <label class="form-check-label" for="is_active"> Active </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-2 me-1"> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
