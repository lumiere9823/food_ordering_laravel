<div class="w3ls-header">
    <!-- header-one -->
    <div class="container">
        <div class="w3ls-header-left">
            <a style="text-decoration:none; color:white" href="{{ url('/') }}">Click to go to home page</a>
        </div>
        <div class="w3ls-header-right">
            <ul>
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
                <li class="head-dpdn dropdown" style="position: relative;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i> Your Orders
                    </a>
                    <ul class="dropdown-menu" style="overflow-y: auto; max-height: 300px;">
                        @foreach ($orders as $index => $order)
                        <li style="width:200px;margin-top:20px;">
                            <div>
                                <div style="display: flex;justify-content: space-between;">
                                    <p>Order {{$index+1}}</p>
                                    <p>Total {{$order->order_total}}</p>
                                </div>
                                <p>Payment: {{$order->payment_type}}</p>
                                <p>Status: {{$order->order_status}}</p>
                            </div>
                        </li>
                        <button class="btn btn-info" data-toggle="modal"
                            data-target="#orderDetailModal{{ $order->order_id }}"
                            style="width:200px;margin:20px;padding:10px">Detail</button>
                        <form method="POST" action="{{ route('delete_order', $order->order_id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button id="deleteOrderBtn_{{ $order->order_id }}" class="btn btn-danger show_confirm"
                                style="width:200px;margin:20px;padding:10px" data-toggle="tooltip" title='Delete'>Hủy
                                đơn</button>
                        </form>
                        <hr style="margin:0 !important">
                        @endforeach
                    </ul>

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