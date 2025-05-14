<div class="header-top">
    <div class="container">
        <div class="header-left">
            <a href="tel:#"><i class="icon-phone"></i>Call: +01688 034 515</a>
        </div><!-- End .header-left -->

        <div class="header-right">

            <ul class="top-menu">
                <li>
                    <a href="#">Links</a>
                    <ul>
                        @if(auth()->check())
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">{{ auth()->user()->first_name }}</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li>
                                                <a href="{{ route('frontend.auth.account.index') }}">My Account</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('frontend.auth.logout') }}"
                                                      method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link">Logout</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div>
                            </li>
                        @else
                            <li><a href="#signin-modal" data-toggle="modal">Sign in / Sign up</a></li>
                        @endif
                    </ul>
                </li>
            </ul><!-- End .top-menu -->
        </div><!-- End .header-right -->

    </div><!-- End .container -->
</div>
