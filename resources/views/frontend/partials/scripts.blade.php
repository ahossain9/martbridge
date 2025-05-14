<script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.hoverIntent.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/superfish.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
{{--<script src="{{ asset('frontend/assets/js/site.js') }}"></script>--}}
<script src="{{ asset('frontend/assets/js/site-new.js') }}"></script>
<script src="{{ asset('frontend/assets/js/toastr.min.js') }}"></script>

{!! Toastr::message() !!}

<script>
    window.addEventListener('alert', event => {
        toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
    });
</script>

<script>
    $('#main_search').on('click', function (e) {
        // need to blur the background of the page, then show the search results
        // in a modal
        $('#productSearchModal').modal('show');

        $('#searchInput').on('keyup', function () {
            let query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: "/search",
                    method: 'GET',
                    data: {query: query},
                    dataType: 'json',
                    success: function (data) {
                        $('#searchResults').fadeIn();
                        let html = '';
                        data.forEach(function (item) {
                            html += `<li>
                                <img src="${item.image}" alt="Product Image" style="height: 64px; width: 64px;">
                                    <div class="product-info">
                                        <h3><a href="/shop/${item.slug}" target="_blank">${item.name}</a></h3>
                                        <p class="price">৳ ${item.price}</p>
                                    </div>
                            </li>`;
                        });

                        // if no results
                        if (data.length === 0) {
                            html = '<li class="search-item"><a href="#">No results found</a></li>';
                        }

                        $('#searchResults').html(html);

                    }
                })
            } else {
                $('#searchResults').fadeOut();
            }
        });

    });
</script>
