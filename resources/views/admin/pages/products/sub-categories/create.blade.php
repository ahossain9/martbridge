<div class="modal fade" id="addProductSubCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add new Sub Category </h1>
                    <p>Sub Category name must be unique.</p>
                </div>
                <form class="row" method="POST" action="{{ route('admin.product_manage.sub_categories.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 mb-1">
                        <label class="form-label" for="product_category_id">
                            <strong>Chose Product Category</strong>
                        </label>
                        <select class="form-select" id="product_category_id" name="product_category_id" required>
                            <option value="">Choose product category</option>
                            @foreach($product_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-1">
                        <label class="form-label" for="name">Sub Category Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Sub Category Name" autofocus data-msg="Please enter sub category name" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="image">Logo</label>
                        <input type="file" id="image" name="image" class="form-control" />
                    </div>
                    <div class="col-12 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_shown_to_home_page"
                                   name="is_shown_to_home_page" tabindex="3" />
                            <label class="form-check-label" for="is_shown_to_home_page"> Show On Home Page </label>
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="is_active" tabindex="3" checked/>
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
