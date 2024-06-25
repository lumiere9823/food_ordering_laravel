<div class="banner">
    <!-- header -->
    <div class="header">

        <!-- //header-one -->
        <!-- navigation -->
        <div class="navigation agiletop-nav">
            <div class="container">
                <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header w3l_logo">
                        <h1><a href="{{ url('/') }}">Lì xì shop</a></h1>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                        <ul class="nav navbar-nav navbar-right">
                            @foreach ($categories as $category)
                                <li>
                                    <a
                                        href="{{ route('dish_show', ['category_id' => $category->category_id]) }}">{{ $category->category_name }}</a>
                                </li>
                            @endforeach
                            @if (!Auth::check())
                                <li class="w3pages">
                                    <a href="{{ route('cart_show') }}">Your Cart</a>
                                </li>
                            @endif
                            @if (Auth::check())
                                @if (Auth::check())
                                    <li class="head-dpdn dropdown" style="position: relative;">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown-menu" style="color:#E14740">
                                            @if (Auth::user()->role !== 3)
                                                @if (Auth::check() && Auth::user()->role == '1')
                                                    <li><a href="{{ route('home.index') }}"
                                                            style="color:#E14740">Dashboard</a></li>
                                                @else
                                                    <li><a href="{{ route('order_manage_shipper') }}"
                                                            style="color:#E14740">Orders</a></li>
                                                @endif
                                            @else
                                            @endif
                                            <li class="w3pages">
                                                <a href="{{ route('cart_show') }}">Your Cart</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                                <li class="head-dpdn dropdown" style="position: relative;">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user" aria-hidden="true"></i> Your Orders
                                    </a>
                                    <ul class="dropdown-menu"
                                        style="overflow-y: auto; max-height: 300px;min-width:250px;overflow-x:hidden">
                                        @foreach ($orders as $index => $order)
                                            <li style="width:200px;margin-top:20px;margin-left:20px ">
                                                <div>
                                                    <div style="display: flex;justify-content: space-between;">
                                                        <p>Order {{ $index + 1 }}</p>
                                                        <p>Total {{ $order->order_total }}</p>
                                                    </div>
                                                    <p>Payment: {{ $order->payment_type }}</p>
                                                    <p>Status: {{ $order->order_status }}</p>
                                                </div>
                                            </li>
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target="#orderDetailModal{{ $order->order_id }}"
                                                style="width:200px;margin:20px;padding:10px">Detail</button>
                                            <form method="POST"
                                                action="{{ route('delete_order', $order->order_id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button id="deleteOrderBtn_{{ $order->order_id }}"
                                                    class="btn btn-danger show_confirm"
                                                    style="width:200px;margin:20px;padding:10px" data-toggle="tooltip"
                                                    title='Delete'>Hủy
                                                    đơn</button>
                                            </form>
                                            <hr style="margin:0 !important">
                                        @endforeach
                                    </ul>

                                </li>
                                <li class="head-dpdn">
                                    <a href="{{ route('logout.perform') }}"><i class="fa fa-sign-in"
                                            aria-hidden="true"></i>
                                        Logout</a>
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
                                    </div>
                                </div>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
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
