@extends('admin.layouts.master')

@section('admin-title', 'Users')

@section('admin-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Edit User</h3>
                <p>Who are access to the admin panel with their permissions.</p>
            </div>
        </div>
        @include('admin.partials.message')

        <!-- Permission Table -->
        <div class="card">
            <div class="card-body">
                <form class="row" method="POST" action="{{ route('admin.user_manage.users.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label class="form-label" for="user_first_name-{{$user->id}}">Name</label>
                        <input type="text" id="user_first_name-{{$user->id}}" name="first_name" class="form-control" placeholder="User Name" autofocus data-msg="Please enter user name" value="{{ $user->first_name }}" required />
                    </div>

                    <div class="col-12 mt-1">
                        <label class="form-label" for="user_email-{{$user->id}}">Email</label>
                        <input type="email" id="user_email-{{$user->id}}" name="email" class="form-control" placeholder="User Email" autofocus data-msg="Please enter user name" value="{{ $user->email }}" required />
                    </div>
                    <div class="col-12 mt-1">
                        <label class="form-label" for="user_roles-{{$user->id}}">Roles</label>
                        <select name="user_roles[]" class="select2 form-select" id="user_roles-{{$user->id}}" multiple required>
{{--                            <option value="">Choose a role</option>--}}
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mt-1">
                        <label class="form-label" for="user_password-{{$user->id}}">Password <span class="font-small-1"> ***Skip you do not update the password*** </span></label>
                        <input type="password" id="user_password-{{$user->id}}" name="password" class="form-control" placeholder="User Password" autofocus data-msg="Please enter user password" />
                    </div>
                    <hr>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin-scripts')
    <script src="{{ asset('admin-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
