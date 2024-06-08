<div class="w3ls-header">
    <!-- header-one -->
    <div class="container">
        <div class="w3ls-header-left">
            <a style="text-decoration:none; color:white" href="{{ url('/') }}">Click to go to home page</a>
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
                            <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" style="color:#E14740">
                            <li><a href="{{ route('home.index') }}" style="color:#E14740">Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="head-dpdn">
                        <a href="{{ route('logout.perform') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a>
                    </li>
                @else
                    @if (Session::get('customer_id'))
                        <li class="head-dpdn">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i> {{ Session::get('customer_name') }}
                            </a>
                        </li>
                        <li class="head-dpdn">
                            <a href="#" onclick="document.getElementById('customerLogoutForm').submit();">
                                <i class="fa fa-sign-in" aria-hidden="true"></i> Logout
                            </a>
                            <form id="customerLogoutForm" action="{{ route('logout_customer') }}" method="post">
                                @csrf
                            </form>
                        </li>
                    @else
                        <div style="position: relative; display: inline-block;">
                            <button onclick="toggleDropdown()"
                                style="background-color: #4CAF50; color: white; padding: 16px; font-size: 16px; border: none; cursor: pointer;">
                                <i class="fa fa-user" aria-hidden="true"></i> Account
                            </button>
                            <div id="dropdownContent"
                                style="display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                                <a href="{{ route('login.perform') }}"
                                    style="color: black; padding: 12px 16px; text-decoration: none; display: block;"><i
                                        class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                                <a href="{{ route('register.perform') }}"
                                    style="color: black; padding: 12px 16px; text-decoration: none; display: block;"><i
                                        class="fa fa-user-plus" aria-hidden="true"></i> Signup</a>
                                <a href="{{ route('sign_in') }}"
                                    style="color: black; padding: 12px 16px; text-decoration: none; display: block;"><i
                                        class="fa fa-user-plus" aria-hidden="true"></i> Signin Customer</a>
                                <a href="{{ route('sign_up') }}"
                                    style="color: black; padding: 12px 16px; text-decoration: none; display: block;"><i
                                        class="fa fa-sign-in" aria-hidden="true"></i> Register Customer</a>
                            </div>
                        </div>
                    @endif
                @endauth
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<script>
    function toggleDropdown() {
        var dropdownContent = document.getElementById("dropdownContent");
        if (dropdownContent.style.display === "none") {
            dropdownContent.style.display = "block";
        } else {
            dropdownContent.style.display = "none";
        }
    }
</script>
