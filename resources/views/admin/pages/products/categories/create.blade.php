<div class="modal fade" id="addProductCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add new category </h1>
                    <p>Category name must be unique.</p>
                </div>
                <form class="row" method="POST" action="{{ route('admin.product_manage.categories.store') }}">
                    @csrf
                    <div class="col-12 mb-1">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Category Name" autofocus data-msg="Please enter group name" required />
                    </div>
{{--                    <div class="col-12">--}}
{{--                        <label class="form-label" for="slug">Slug</label>--}}
{{--                        <input type="text" id="slug" name="slug" class="form-control" placeholder="Category slug Name" autofocus data-msg="Please enter slug name" required />--}}
{{--                    </div>--}}

                    <div class="col-12 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="is_active" tabindex="3" checked />
                            <label class="form-check-label" for="is_active"> Active </label>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Create </button>
                        <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
