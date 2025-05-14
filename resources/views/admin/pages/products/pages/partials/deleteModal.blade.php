<div class="modal fade modal-danger text-start" id="deleteProductModal-{{ $product->id }}" tabindex="-1"
     aria-labelledby="deleteProductModal-{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModal-{{ $product->id }}">!!! Delete Confirmation !!! <span
                        class="badge badge-glow bg-info"> {{ $product->name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure to delete this product? It will not be possible to recover it anymore.
            </div>
            <form action="{{ route('admin.product_manage.products.destroy', $product->id) }}"
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
