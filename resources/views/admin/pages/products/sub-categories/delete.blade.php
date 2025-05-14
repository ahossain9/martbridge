<div class="modal fade modal-danger text-start" id="subCategoryDeleteModal-{{ $sub_category->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel120">!!! Delete Confirmation !!!  <span class="badge badge-glow bg-warning">{{ $sub_category->name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are your sure to delete this sub category? It won't be able to recover.
            </div>

            <div class="modal-footer">
                <form id="{{ $sub_category->id }}" action="{{ route('admin.product_manage.sub_categories.destroy', $sub_category) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-block">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
