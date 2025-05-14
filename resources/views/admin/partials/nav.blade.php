<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('admin.crm.contact_requests.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email"><i class="ficon" data-feather="mail"></i></a></li>
            </ul>
<!--            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>
                    <div class="bookmark-input search-input">
                        <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
                        <ul class="search-list search-list-bookmark"></ul>
                    </div>
                </li>
            </ul>-->
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Search your query" tabindex="-1" data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i>
<!--                    <span class="badge rounded-pill bg-danger badge-up">5</span>-->
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                            <div class="badge rounded-pill badge-light-primary">0 New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading">No Notification!</p>
                                </div>
                            </div>
                        </a>
<!--                        <a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar"><img src="{{ asset('admin-assets/images/portrait/small/avatar-s-3.jpg') }}" alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">New message</span>&nbsp;received</p><small class="notification-text"> You have 10 unread messages</small>
                                </div>
                            </div>
                        </a>
                        <a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content">MD</div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Revised Order 👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order updated</small>
                                </div>
                            </div>
                        </a>-->

                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Read all notifications</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">{{ \auth()->user()->first_name .' '. \auth()->user()->last_name }}</span><span class="user-status">
                            {{ auth('admin')->user()->roles->first()->name }}
                            </span></div><span class="avatar"><img class="round" src="{{ asset('admin-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user"><a class="dropdown-item" href="#">
                        <i class="me-50" data-feather="user">
                        </i> Profile</a>
                    <a class="dropdown-item" href=""><i class="me-50" data-feather="mail"></i> Inbox</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href=""><i class="me-50" data-feather="settings"></i> Settings</a>
                    <div class="dropdown-item" href="{{
                            route('admin.auth.logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="me-50" data-feather="power"></i> Logout</div>
                    <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
