<div class="modal fade modal-danger text-start" id="deleteSliderModal-{{ $slider->id }}" tabindex="-1" aria-labelledby="deleteLabel-{{ $slider->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel-{{ $slider->id }}">!!! Delete Confirmation !!!  <span class="badge badge-glow bg-warning">{{ $slider->name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are your sure to delete this slider? It won't be able to recover.
            </div>
            <div class="modal-footer">
                <form id="{{ $slider->id }}" action="{{ route('admin.sliders.destroy', ['slider' => $slider]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-block">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
