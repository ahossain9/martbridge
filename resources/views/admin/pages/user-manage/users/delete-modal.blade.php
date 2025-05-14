<div class="modal fade modal-danger text-start" id="UserDeleteModal-{{ $user->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel120">!!! Delete Confirmation !!!  <span class="badge badge-glow bg-warning">{{ $user->first_name .' '. $user->last_name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are your sure to delete this user? It won't be able to recover.
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.user_manage.users.destroy', $user) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
