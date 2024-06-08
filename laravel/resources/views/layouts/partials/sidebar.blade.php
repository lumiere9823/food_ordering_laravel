<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        @auth
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{!! url('dist/img/user2-160x160.jpg') !!}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endauth


        <!-- search form (Optional) -->
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
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
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
                <a href="#"><i class="fa fa-link"></i> <span>Delivery Boy</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('show_delivery_boy_table') }}">Add</a></li>
                    <li><a href="{{ route('manage_delivery_boy') }}">Manage</a></li>
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
                <a href="#"><i class="fa fa-link"></i> <span>Customer Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('order_manage') }}">Manage</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
