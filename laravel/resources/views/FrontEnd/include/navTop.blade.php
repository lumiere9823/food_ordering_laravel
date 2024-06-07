<div class="w3ls-header">
    <!-- header-one -->
    <div class="container">
        <div class="w3ls-header-left">
            <a style="text-decoration:none; color:white" href="{{url('/')}}">Click to go to home page</a>
        </div>
        <div class="w3ls-header-right">
            <ul>
                <li class="head-dpdn">
                    <i class="fa fa-phone" aria-hidden="true"></i> Call us:
                </li>

                <li class="head-dpdn">
                    <a href="#"><i class="fa fa-gift" aria-hidden="true"></i> Offers</a>
                </li>
                <li class="head-dpdn">
                    <a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> Help</a>
                </li>
                @auth
                <li class="head-dpdn dropdown" style="position: relative;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i> {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu" style="color:#E14740">
                        <li><a href="{{route('home.index')}}" style="color:#E14740">Dash Board</a></li>
                    </ul>
                </li>
                <li class="head-dpdn">
                    <a href="{{ route('logout.perform') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>
                        Logout</a>
                </li>
                @endauth
                @guest
                <li class="head-dpdn">
                    <a href="{{ route('login.perform') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>
                        Login</a>
                </li>
                <li class="head-dpdn">
                    <a href="{{ route('register.perform') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>
                        Signup</a>
                </li>
                @endguest
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>