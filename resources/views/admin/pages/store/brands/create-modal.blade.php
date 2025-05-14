<!-- Add Permission Modal -->
<div class="modal fade" id="addBrandCreateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add Brand</h1>
                </div>
                <form class="row" method="POST" action="{{ route('admin.store.brands.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="name">Name *</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Example: Samsung" autofocus data-msg="Please enter brand name" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="logo">Logo</label>
                        <input type="file" id="logo" name="logo" class="form-control" />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="description"><strong>About the brand (This will be visible to customers)</strong></label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="4"></textarea>
                    </div>

                    <div class="col-12 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="is_active" tabindex="3" />
                            <label class="form-check-label" for="is_active"> Active </label>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Create</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
