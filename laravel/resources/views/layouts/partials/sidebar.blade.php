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
            @if(Auth::user()->role == 1)
            <li>
                <a href="{{route('home.index')}}"><i class="fa fa-link"></i> <span>dashboard</span>
                </a>
            </li>
            
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
                <a href="#"><i class="fa fa-link"></i> <span>Dish</span>
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
                    <li><a href="{{ route('manage_user') }}">Manage</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Customer Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('order_manage') }}">Manage</a></li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->role == 2 || Auth::user()->role == 1)
            <li>
                <a href="#"><i class="fa fa-link"></i> <span>Đơn hàng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            <li>
                <a href="#"><i class="fa fa-link"></i> <span>Đơn hàng đã nhận</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            @endif

        </ul>
    </section>
</aside>
