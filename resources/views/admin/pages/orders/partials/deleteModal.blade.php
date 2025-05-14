<div class="modal fade modal-danger text-start" id="deleteOrderModal-{{ $order->id }}" tabindex="-1"
     aria-labelledby="deleteOrderModal-{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteOrderModal-{{ $order->id }}">!!! Delete Confirmation !!! <span
                        class="badge badge-glow bg-info"> {{ $order->name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure to delete this product? It will not be possible to recover it anymore.
            </div>
            <form action="{{ route('admin.manage_orders.orders.destroy', $order->id) }}"
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
