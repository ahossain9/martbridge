<div class="position-relative opacity-25" wire:ignore>
    <div class="header-center">
        <div
            class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
            <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
            <form action="#" method="get">
                <div class="header-search-wrapper search-wrapper-wide">
                    <div class="select-custom">
                        <select id="cat" name="cat">
                            <option value="">All Departments</option>
                            @foreach($categories as $key => $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @foreach($cat->productSubCategories as $child)
                                    <option value="{{ $child->id }}">- {{ $child->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <style>
                        .main-search:hover {
                            cursor: pointer;
                        }
                    </style>
                    <span class="form-control main-search" id="main_search"></span>
                    <button class="btn btn-primary" type="button"><i class="icon-search"></i></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Modal -->
    <div class="modal fade" id="productSearchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Search</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" id="searchInput" placeholder="Enter search term">
                        </div>
                    </form>

                    <ul class="product-list" id="searchResults">
                        <li class="">
                            <p></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
