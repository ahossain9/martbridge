@extends('admin.layouts.master')

@section('admin-title', 'Create Vendor')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>New Vendor</h3>
            </div>

            <div class="">
                <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
        @include('admin.partials.message')

        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <form class="row" method="POST" action="{{ route('admin.store.vendors.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 mb-1">
                        <label class="form-label" for="name"><strong>Vendor Name *</strong></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Techs Tronix" autofocus data-msg="Please enter vendor name" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="email"><strong>Email *</strong></label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Ex: mail@example.com" autofocus data-msg="Please enter vendor email" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="phone"><strong>Phone *</strong></label>
                        <input type="number" id="phone" name="phone" class="form-control" placeholder="Ex: 01xxxxxxx" autofocus data-msg="Please enter vendor name" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="phone"><strong>City *</strong></label>
                        <input type="text" id="city" name="city" class="form-control" placeholder="Ex: Dhaka" autofocus data-msg="Please enter City" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="logo"><strong>Logo </strong></label>
                        <input type="file" id="logo" name="logo" class="form-control" />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="banner"><strong>Banner </strong></label>
                        <input type="file" id="banner" name="banner" class="form-control" />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="address"><strong>Address *</strong></label>
                        <textarea name="address" id="address" class="form-control" cols="30" rows="2" required></textarea>
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="about"><strong>About your store (This will be visible to customers)</strong></label>
                       <textarea name="about" id="about" class="form-control" cols="30" rows="4" required></textarea>
                    </div>

                    <div class="col-12 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="is_active" tabindex="3" />
                            <label class="form-check-label" for="is_active"> Active </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Create </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
