<?php

use Illuminate\Support\Facades\Route;

$adminUser = auth('admin')->user();

?>

    <!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <span class="brand-logo d-flex justify-content-center">
                       <img src="{{ asset('admin-assets/images/logo/logo.png') }}" alt="">
                    </span>
                    <h2 class="brand-text">{{ \App\Constants\AdminConstant::APP_NAME }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if($adminUser->can('dashboard view'))
                <li class="nav-item {{ Route::is('admin.index') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ url('/admin/dashboard') }}"><i
                            data-feather="home"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span></a>
                </li>
            @endif

            @if($adminUser->hasAnyPermission(['contact request read']))
                <li class=" navigation-header"><span data-i18n="User Interface">CRM</span><i
                        data-feather="more-horizontal"></i></li>

                <li class="nav-item
                @if(Route::is('admin.crm.*'))
                    active
               @endif
                ">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather="user-check"></i>
                        <span class="menu-title text-truncate" data-i18n="CRM">
                        CRM
                        @if(countContactRequests() > 0)
                                <span class="badge bg-danger rounded-pill ms-auto">{{ countContactRequests() }}</span>
                            @endif
                    </span></a>
                    <ul class="menu-content">
                        @if($adminUser->can('contact request read'))
                            <li class="{{ Route::is('admin.crm.contact_requests.*') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                   href="{{ route('admin.crm.contact_requests.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Accordion">Contact Reqs
                                @if(countContactRequests() > 0)
                                            <span class="badge bg-primary rounded-pill ms-auto">
                                        {{ countContactRequests() }}
                                    </span>
                                        @endif
                            </span>
                                </a>
                            </li>
                        @endif
                        @if($adminUser->can('contact request read'))
                            <li class="{{ Route::is('admin.crm.newsletter_subscriber.*') ? 'active' : '' }}">
                                @php
                                    $newsletterSubscribersCount = \App\Models\NewsletterSubscriber::count();
                                @endphp
                                <a class="d-flex align-items-center"
                                   href="{{ route('admin.crm.newsletter_subscriber.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Accordion">
                                        Subscribers
                                @if($newsletterSubscribersCount > 0)
                                            <span class="badge bg-primary rounded-pill ms-auto">
                                        {{ $newsletterSubscribersCount }}
                                    </span>
                                        @endif
                            </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if($adminUser->hasAnyPermission(['vendor read', 'brand read']))
                <li class=" navigation-header"><span data-i18n="User Interface">Store</span><i
                        data-feather="more-horizontal"></i></li>

                <li class="nav-item
                @if(Route::is('admin.store.vendors.*') || Route::is('admin.store.brands.*'))
                    active
               @endif
                "><a class="d-flex align-items-center" href="#"><i data-feather="briefcase"></i><span
                            class="menu-title text-truncate" data-i18n="Components">Store front </span></a>
                    <ul class="menu-content">
                        @if($adminUser->can('vendor read'))
                            <li class="{{ Route::is('admin.store.vendors.*') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                   href="{{ route('admin.store.vendors.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Accordion">Vendors</span>
                                </a>
                            </li>
                        @endif
                        @if($adminUser->can('brand read'))
                            <li class="{{ Route::is('admin.store.brands.*') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                   href="{{ route('admin.store.brands.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Accordion">Brands</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if($adminUser->hasAnyPermission(['home slider read']))
                <li class=" navigation-header"><span data-i18n="User Interface">Manage Home</span><i
                        data-feather="more-horizontal"></i></li>

                <li class="nav-item
                @if(Route::is('admin.sliders.*'))
                    active
               @endif
                ">
                    <a class="d-flex align-items-center" href="#"><i data-feather="sliders"></i><span
                            class="menu-title text-truncate" data-i18n="Components">Sliders &amp; Banner </span></a>
                    <ul class="menu-content">
                        @if($adminUser->can('home slider read'))
                            <li class="{{ Route::is('admin.sliders.*') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                   href="{{ route('admin.sliders.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Accordion">Home Slider</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if($adminUser->hasAnyPermission(['category read', 'sub category read', 'attribute read', 'product read']))
                <li class=" navigation-header"> Manage Products</li>
            @endif

            @if($adminUser->can('category read'))
                <li class=" nav-item
                @if(Route::is('admin.product_manage.categories.*'))
                    active
               @endif ">
                    <a class="d-flex align-items-center" href="{{ route('admin.product_manage.categories.index') }}">
                        <i data-feather='layers'></i><span class="menu-title text-truncate"
                                                           data-i18n="Categories">Categories</span></a>
                </li>
            @endif

            @if($adminUser->can('sub category read'))
                <li class=" nav-item
                @if(Route::is('admin.product_manage.sub_categories.*'))
                    active
               @endif ">
                    <a class="d-flex align-items-center"
                       href="{{ route('admin.product_manage.sub_categories.index') }}">
                        <i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Categories">Sub Categories</span></a>
                </li>
            @endif

            @if($adminUser->can('attribute read'))
                <li class=" nav-item
                @if(Route::is('admin.product_manage.attributes.*'))
                    active
               @endif ">
                    <a class="d-flex align-items-center" href="{{ route('admin.product_manage.attributes.index') }}"><i
                            data-feather="trello"></i><span class="menu-title text-truncate"
                                                            data-i18n="Categories">Attributes</span></a>
                </li>
            @endif

            @if($adminUser->can('product read'))
                <li class=" nav-item
                @if(Route::is('admin.product_manage.products.*'))
                    active
               @endif ">
                    <a class="d-flex align-items-center" href="{{ route('admin.product_manage.products.index') }}">
                        <i data-feather='codesandbox'></i><span class="menu-title text-truncate"
                                                                data-i18n="Categories">Products</span></a>
                </li>
            @endif

            <li class=" nav-item
                {{ Route::is('admin.product_manage.labels.*') ? 'active' : '' }}
                ">
                <a class="d-flex align-items-center"
                   href="{{ route('admin.product_manage.labels.index') }}">
                    <i data-feather='flag'></i>
                    <span class="menu-title text-truncate">Labels</span></a>
            </li>

            @if($adminUser->hasAnyPermission(['order read']))
                <li class="navigation-header"> Manage Orders</li>
            @endif

            @if($adminUser->can('order read'))
                <li class="nav-item
                @if(Route::is('admin.manage_orders.orders.*'))
                    active
               @endif ">
                    <a class="d-flex align-items-center" href="{{ route('admin.manage_orders.orders.index') }}">
                        <i data-feather='shopping-cart'></i><span class="menu-title text-truncate"
                                                                  data-i18n="Categories">
                        Orders
                        <span class="badge bg-primary rounded-pill ms-auto">
                            {{ \App\Helpers\OrderHelper::getPendingOrdersCount() }}
                        </span>
                    </span></a>
                </li>
            @endif

                @if($adminUser->hasAnyPermission(['customer read']))
                    <li class="navigation-header"> Manage Customer</li>
                @endif

                @if($adminUser->can('customer read'))
                    <li class="nav-item
                @if(Route::is('admin.manage_customer.customers.*'))
                    active
               @endif ">
                        <a class="d-flex align-items-center" href="{{ route('admin.manage_customer.customers.index') }}">
                            <i data-feather='shopping-cart'></i><span class="menu-title text-truncate"
                                                                      data-i18n="Categories">
                        Customers
                        <span class="badge bg-primary rounded-pill ms-auto">
                            {{ \App\Models\Customer::count() }}
                        </span>
                    </span></a>
                    </li>
                @endif

            @if($adminUser->hasAnyPermission(['admin read', 'role read', 'permission read']))
                <li class=" navigation-header"><span data-i18n="User Interface">User Manage</span><i
                        data-feather="more-horizontal"></i>
                </li>

                <li class=" nav-item
                @if(Route::is('admin.user_manage.roles.*') || Route::is('admin.user_manage.permissions.*'))
                    active
               @endif
                "><a class="d-flex align-items-center" href="#"><i data-feather="briefcase"></i><span
                            class="menu-title text-truncate" data-i18n="Components">Users & Access </span></a>
                    <ul class="menu-content">
                        @if($adminUser->can('admin read'))
                            <li class="{{ Route::is('admin.user_manage.users.*') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                   href="{{ route('admin.user_manage.users.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Accordion">Admin Users</span>
                                </a>
                            </li>
                        @endif

                        @if($adminUser->can('role read'))
                            <li class="{{ Route::is('admin.user_manage.roles.*') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                   href="{{ route('admin.user_manage.roles.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Accordion">Roles</span>
                                </a>
                            </li>
                        @endif

                        @if($adminUser->can('permission read'))
                            <li class="{{ Route::is('admin.user_manage.permissions.*') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                   href="{{ route('admin.user_manage.permissions.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Alerts">Permissions</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
