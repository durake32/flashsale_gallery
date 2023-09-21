<div class="sidebar-wrapper">
    <?php $segment1 = Request::segment(1);?>
    @include('Dashboard.partials.user-info')
    <ul class="nav">
        <li class="nav-item">

            <a class="nav-link" href="{{ $settings[0]['site_url'] }}" target="_blank">
                <i class="fas fa-globe"></i>
                <p> Visit Site </p>
            </a>
        </li>
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'dashboard']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'dashboard') }}">
                <i class="fa fa-dashboard"></i>
                <p> Dashboard </p>
            </a>
        </li>


        @can('brand view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'brand*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'brand') }}">
                <i class="fas fa-cube fa-fw"></i>
                <p> Brand </p>
            </a>
        </li>
        @endcan
        @can('product view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'product*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'product') }}">
                <i class="fa fa-product-hunt"></i>
                <p> Product </p>
            </a>
        </li>
        @endcan
        @can('category view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'category*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'category') }}">
                <i class="fas fa-sitemap"></i>
                <p> Category </p>
            </a>
        </li>
        @endcan



        @if ($segment1 == 'admin')
        @can('order view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'order']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'order') }}">
                <i class="fas fa-cart-plus"></i>
                <p> Orders </p>
            </a>
        </li>
        @endcan
        @can('offline-order view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'offline-orders']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ route('admin.offlineorders.index') }}">
                <i class="fas fa-shopping-cart"></i>
                <p> Offline Orders </p>
            </a>
        </li>
        @endcan
        @can('banner view')

        <li class="nav-item {{ Request::is([$segment1 . '/' . 'banner*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'banner') }}">
                <i class="fas fa-images"></i>
                <p> Banners </p>
            </a>
        </li>

        @endcan

        @can('is_super_admin')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'admin*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'admin') }}">
                <i class="fas fa-user-secret"></i>
                <p> Admins </p>
            </a>
        </li>
        @endcan

        @can('retailer view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'retailer*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'retailer') }}">
                <i class="fas fa-users-cog"></i>
                <p> Retailers </p>
            </a>
        </li>

        @endcan
        @can('customer view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'customer*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'customer') }}">
                <i class="fas fa-user-plus"></i>
                @php
                $countuser = \App\Models\User::all()->count();
                @endphp
                <p> Customers &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-default">{{$countuser }}</span>
                </p>
            </a>
        </li>
        @endcan
        @can('wholesaler view')

        <li class="nav-item {{ Request::is([$segment1 . '/' . 'wholesaler*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'wholesaler') }}">
                <i class="fas fa-users"></i>
                <p> Wholesaler </p>
            </a>
        </li>

        @endcan
        @can('page view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'page*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'page') }}">
                <i class="far fa-file-alt"></i>
                <p> Page </p>
            </a>
        </li>

        @endcan
        @can('notification view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'notifications*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'notifications') }}">
                <i class="fas fa-bell"></i>
                <p> Notification </p>
            </a>
        </li>

        @endcan
        @can('query view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'query']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'query') }}">
                <i class="fas fa-question"></i>
                <p> Query </p>
            </a>
        </li>
        @endcan
        @can('advertisement view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'advertisement*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ route('admin.advertisement.index') }}">
                <i class="far fa-file-alt"></i>
                <p> Advertisement </p>
            </a>
        </li>

        <li class="nav-item {{ Request::is([$segment1 . '/' . 'advertisement1*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ route('admin.advertisement1.index') }}">
                <i class="fas fa-ad"></i>
                <p> Advertisement1 </p>
            </a>
        </li>

        <li class="nav-item {{ Request::is([$segment1 . '/' . 'educational-partners*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ route('admin.advertisement2.index') }}">
                <i class="fa fa-handshake-o"></i>
                <p> Educational Partners </p>
            </a>
        </li>
        @endcan
        @can('map view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'map*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ route('admin.map.edit') }}">
                <i class="fa fa-map-marker"></i>
                <p> Map </p>
            </a>
        </li>
        @endcan
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="true">
                <i class="fas fa-cog"></i>
                <p> Settings
                    <b class="caret"></b>
                </p>
            </a>

            <div class="collapse" id="settings" style="">
                <ul class="nav">
                    @can('payment method')
                    <li class="nav-item {{ Request::is([$segment1 . '/' . 'payment-method*']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url(Request::segment(1), 'payment-method') }}">
                            <span class="sidebar-mini"> PM </span>
                            <span class="sidebar-normal"> Payment Method </span>
                        </a>
                    </li>
                    @endcan
                    @can('site setting')
                    <li class="nav-item {{ Request::is([$segment1 . '/' . 'site-settings*']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url(Request::segment(1), 'site-settings') }}">
                            <span class="sidebar-mini"> SS </span>
                            <span class="sidebar-normal"> Site Settings </span>
                        </a>
                    </li>
                    @endcan
                    @can('location view')
                    <li class="nav-item {{ Request::is([$segment1 . '/' . 'locations*']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url(Request::segment(1), 'locations') }}">
                            <span class="sidebar-mini"> L </span>
                            <span class="sidebar-normal"> Location </span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#report" aria-expanded="true">
                <i class="fa fa-chart-bar"></i>
                <p> Report <b class="caret"></b>
                </p>
            </a>

            <div class="collapse" id="report" style="">
                <ul class="nav">
                    <li class="nav-item {{ Request::is([$segment1 . '/' . 'report/customer*']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url(Request::segment(1), 'report/customer') }}">
                            <span class="sidebar-mini"> CR </span>
                            <span class="sidebar-normal"> Customer Report </span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is([$segment1 . '/' . 'report/customer-product*']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url(Request::segment(1), 'report/customer-product') }}">
                            <span class="sidebar-mini"> CPR </span>
                            <span class="sidebar-normal"> CustomerProduct Report </span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is([$segment1 . '/' . 'report/order*']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url(Request::segment(1), 'report/order') }}">
                            <span class="sidebar-mini"> OR </span>
                            <span class="sidebar-normal"> Order Report </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @can('menu view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'menu-category']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ url(Request::segment(1), 'menu-category') }}">
                <i class="fas fa-bars"></i>
                <p> Menus </p>
            </a>
        </li>
        @endcan
        @can('direct-category view')
        <li class="nav-item {{ Request::is([$segment1 . '/' . 'direct-order-category*']) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.directCategory.index') }}">
                <i class="fas fa-edit"></i>
                <p>Direct Category </p>
            </a>
        </li>
        @endcan
        @can('calendar view')

        <li class="nav-item {{ Request::is([$segment1 . '/' . 'calendars*']) ? 'active' : '' }}">

            <a class="nav-link" href="{{ route('admin.calendars.index') }}">
                <i class="far fa-calendar-check"></i>
                <p>Calendar </p>
            </a>
        </li>
        @endcan
        @endif

    </ul>
</div>