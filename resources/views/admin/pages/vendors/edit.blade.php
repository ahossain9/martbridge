@extends('admin.layouts.master')

@section('admin-title', 'Edit Vendor')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Update Vendor - <span class="badge bg-primary">{{ $vendor->name }}</span></h3>
            </div>

            <div class="">
                <a class="btn btn-primary" href="{{ route('admin.store.vendors.index') }}">Back</a>
            </div>
        </div>
        @include('admin.partials.message')

        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <form class="row" method="POST" action="{{ route('admin.store.vendors.update', $vendor) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12 mb-1">
                        <label class="form-label" for="name"><strong>Vendor Name *</strong></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Techs Tronix" autofocus data-msg="Please enter vendor name" value="{{ $vendor->name }}" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="email"><strong>Email *</strong></label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Ex: mail@example.com" autofocus data-msg="Please enter vendor email" value="{{ $vendor->email }}" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="phone"><strong>Phone *</strong></label>
                        <input type="number" id="phone" name="phone" class="form-control" placeholder="Ex: 01xxxxxxx" autofocus data-msg="Please enter vendor name" value="{{ $vendor->phone }}" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="phone"><strong>City *</strong></label>
                        <input type="text" id="city" name="city" class="form-control" placeholder="Ex: Dhaka" autofocus data-msg="Please enter City" value="{{ $vendor->city }}" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="logo"><strong>Logo </strong></label>
                        <input type="file" id="logo" name="logo" class="form-control" />

                        @if($vendor->logo)
                            <div>
                                <img src="{{ \App\Helpers\FileManageHelper::getS3FileUrl($vendor->logo) }}" alt="{{ $vendor->name }}" width="100">
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="banner"><strong>Banner </strong></label>
                        <input type="file" id="banner" name="banner" class="form-control" />
                        @if($vendor->banner)
                            <img src="{{ \App\Helpers\FileManageHelper::getS3FileUrl($vendor->banner) }}" alt="{{ $vendor->name }}" width="100">
                        @endif
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="address"><strong>Address *</strong></label>
                        <textarea name="address" id="address" class="form-control" cols="30" rows="2" required>{{ $vendor->address }}</textarea>
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="about"><strong>About your store (This will be visible to customers)</strong></label>
                        <textarea name="about" id="about" class="form-control" cols="30" rows="4" required>{{ $vendor->about }}</textarea>
                    </div>

                    <div class="col-12 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="is_active" tabindex="3" {{ $vendor->is_active ? 'checked' : '' }} />
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
