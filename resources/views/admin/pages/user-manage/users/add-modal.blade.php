<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add New User</h1>
                    <p>User will access the admin panel with their permissions.</p>
                </div>
                <form class="row" method="POST" action="{{ route('admin.user_manage.users.store') }}">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="user_first_name">Name</label>
                        <input type="text" id="user_first_name" name="first_name" class="form-control" placeholder="User Name" autofocus data-msg="Please enter user name" required />
                    </div>

                    <div class="col-12 mt-1">
                        <label class="form-label" for="user_email">Email</label>
                        <input type="email" id="user_email" name="email" class="form-control" placeholder="User Email" autofocus data-msg="Please enter user name" required />
                    </div>
                    <div class="col-12 mt-1">
                        <label class="form-label" for="user_roles">Roles</label>
                        <select class="select2 form-select" id="user_roles" name="roles[]" multiple required>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mt-1">
                        <label class="form-label" for="user_password">Password</label>
                        <input type="password" id="user_password" name="password" class="form-control" placeholder="User Password" autofocus data-msg="Please enter user password" required />
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Create User</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
