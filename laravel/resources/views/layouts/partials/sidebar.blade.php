<aside class="main-sidebar">

    <section class="sidebar">

        @auth
            <div class="user-panel" style="color:white;">
                <h1>{{ Auth::user()->name }}</h1>
            </div>
        @endauth


        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>

        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('home.index') }}"><i class="fa fa-link"></i> <span>dashboard</span>
                </a>
            </li>
            @if (Auth::user()->role == 1)
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Category</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('show_cate_table') }}">Add category</a></li>
                        <li><a href="{{ route('manage_cate') }}">Manage category</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Coupons</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('show_coupon_table') }}">Add</a></li>
                        <li><a href="{{ route('manage_coupon') }}">Manage</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Product</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('show_dish_table') }}">Add</a></li>
                        <li><a href="{{ route('manage_dish') }}">Manage</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Roles</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('show_role_table') }}">Add</a></li>
                        <li><a href="{{ route('role_manage') }}">Manage</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Users</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('show_user_table') }}">Add</a></li>
                        <li><a href="{{ route('manage_user') }}">Manage All User</a></li>
                        <li><a href="{{ route('manage_shipper') }}">Manage Shipper</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('order_manage') }}"><i class="fa fa-link"></i>
                        <span>Customer Order</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->role == 2)
                <li>
                    <a href="{{ route('order_manage_shipper') }}"><i class="fa fa-link"></i> <span>Đơn hàng</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('order_manage_self_shipper') }}"><i class="fa fa-link"></i> <span>Đơn hàng đã
                            nhận</span>
                    </a>
                </li>
            @endif

        </ul>
    </section>
</aside>
