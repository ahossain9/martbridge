<div class="modal fade modal-danger text-start" id="labelDeleteModal-{{ $label->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel120">!!! Delete Confirmation !!!  <span class="badge badge-glow bg-warning">{{ $label->name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are your sure to delete this label? It won't be able to recover.
            </div>

            <form action="{{ route('admin.product_manage.labels.destroy', $label->id) }}"
                  method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
