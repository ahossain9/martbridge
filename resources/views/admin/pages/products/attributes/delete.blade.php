<div class="modal fade modal-danger text-start" id="deleteVariantModal-{{ $attribute->id }}" tabindex="-1" aria-labelledby="deleteLabel-{{ $attribute->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel-{{ $attribute->id }}">!!! Delete Confirmation !!!  <span class="badge badge-glow bg-warning">{{ $attribute->name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are your sure to delete this attribute? It won't be able to recover and attached attribute values will be deleted.
            </div>
            <div class="modal-footer">
                <form id="{{ $attribute->id }}" action="{{ route('admin.product_manage.attributes.destroy', ['attribute' => $attribute]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-block">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
