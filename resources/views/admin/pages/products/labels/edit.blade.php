<div class="modal fade" id="labelEditModal-{{$label->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit Label</h1>
                </div>
                <form id="addPermissionForm" class="row" method="POST" action="{{ route('admin.product_manage.labels.update', $label) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-12 mb-1">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Label Name" autofocus data-msg="Please enter label name" value="{{ $label->name }}" required />
                    </div>

                    <div class="col-12 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active"
                                   name="is_active" tabindex="3" {{ $label->is_active ? 'checked' : '' }} />
                            <label class="form-check-label" for="is_active"> Active </label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
