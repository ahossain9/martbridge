<div class="modal fade modal-danger text-start" id="categoryDeleteModal-{{ $category->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel120">!!! Delete Confirmation !!!  <span class="badge badge-glow bg-warning">{{ $category->name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are your sure to delete this category? It won't be able to recover.
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-danger"
                   onclick="event.preventDefault(); document.getElementById('delete-form-{{ $category }}').submit();">Yes, Delete</a>

                <form id="delete-form-{{ $category }}" action="{{ route('admin.product_manage.categories.destroy', $category) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
