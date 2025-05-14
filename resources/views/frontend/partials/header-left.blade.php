<div class="header-left">
    <div class="dropdown category-dropdown">
        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false" data-display="static" title="Browse Categories">
            Browse Categories <i class="icon-angle-down"></i>
        </a>

        <div class="dropdown-menu">
            <nav class="side-nav">
                <ul class="menu-vertical sf-arrows">
                    <!--                                    <li class="item-lead"><a href="#">Daily offers</a></li>
                                                        <li class="item-lead"><a href="#">Gift Ideas</a></li>-->
                    @foreach(\App\Helpers\ProductHelper::getSubcategoryByAlphabet() as $subCat)
                        <li><a href="{{ route('frontend.shop.index', ['category' => $subCat->name]) }}">{{ $subCat->name }}</a></li>
                    @endforeach
                </ul><!-- End .menu-vertical -->
            </nav><!-- End .side-nav -->
        </div><!-- End .dropdown-menu -->
    </div><!-- End .category-dropdown -->
</div>
