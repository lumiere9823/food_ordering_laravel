<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('home.index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li style="width: 90px; padding:5px">
                    <a href="/" class="btn btn-success no-hover-color" style="cursor: pointer;">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <!-- User Account Menu -->
                @auth
                    <li class="dropdown user user-menu" style="padding: 5px">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{!! url('dist/img/user2-160x160.jpg') !!}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{!! url('dist/img/user2-160x160.jpg') !!}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->name }} - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-warning">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout.perform') }}" class="btn btn-danger">Sign out</a>
                                </div>


                            </li>
                        </ul>
                    </li>
                @endauth
                @guest
                    <div class="pull-left" style="padding-top : 8px">
                        <a href="{{ route('login.perform') }}" class="btn btn-success">Login</a>
                        <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
                    </div>
                @endguest
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
