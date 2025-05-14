<div class="header-middle">
    <div class="container">
        <div class="header-left">
            <button class="mobile-menu-toggler">
                <span class="sr-only">Toggle mobile menu</span>
                <i class="icon-bars"></i>
            </button>

            <a href="{{ url('/') }}" class="logo d-flex justify-content-center" >
                <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="{{ $appName }} Logo" width="60"
                     height="45">
                <h3 class="text-white"><strong>{{ $appName }}</strong></h3>
            </a>
        </div>

        <div class="header-center">
            <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                <form action="#" method="get">
                    <div class="header-search-wrapper search-wrapper-wide">
                        <label for="q" class="sr-only">Search</label>
                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        <style>
                            .main-search:hover {
                                cursor: pointer;
                            }
                        </style>
                        <span class="form-control main-search" id="main_search"></span>
                    </div>
                </form>
            </div><!-- End .header-search -->
        </div>

        <div class="header-right">
            <livewire:wishlist-nav wire:key="wishlist-nav" />
            <livewire:shopping-cart wire:key="header-component" />

        </div><!-- End .header-right -->
    </div><!-- End .container -->
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
