<!-- Edit Permission Modal -->
<div class="modal fade" id="UserEditModal-{{$user->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit Admin -{{ $user->first_name .' '. $user->last_name }}</h1>
                </div>
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
                            <option value="">Choose a role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mt-1">
                        <label class="form-label" for="user_password-{{$user->id}}">Password <span class="font-small-1"> ***Skip you do not update the password*** </span></label>
                        <input type="password" id="user_password-{{$user->id}}" name="password" class="form-control" placeholder="User Password" autofocus data-msg="Please enter user password" />
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Edit Permission Modal -->
