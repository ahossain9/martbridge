<div class="modal fade modal-danger text-start" id="deleteVariantModal-{{ $vendor->id }}" tabindex="-1" aria-labelledby="deleteLabel-{{ $vendor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel-{{ $vendor->id }}">!!! Delete Confirmation !!!  <span class="badge badge-glow bg-warning">{{ $vendor->name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are your sure to delete this vendor? It won't be able to recover.
            </div>
            <div class="modal-footer">
                <form id="{{ $vendor->id }}" action="{{ route('admin.store.vendors.destroy', ['vendor' => $vendor]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-block">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
