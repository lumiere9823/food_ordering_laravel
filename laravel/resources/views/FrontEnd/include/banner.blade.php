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
@if (isset($orders))
@if (isset($order))
<div class="modal fade" id="orderDetailModal{{ $order->order_id }}" tabindex="-1" role="dialog"
                        aria-labelledby="orderDetailModalLabel{{ $order->order_id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="border-radius: 16px;">
                                <div class="modal-header"
                                    style="background: #ccc; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <h5 class="modal-title" id="orderDetailModalLabel{{ $order->order_id }}">Order Detail
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div
                                        style="border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); margin-bottom: 20px;">
                                        <div style="background-color: #f8f9fa; padding: 10px;">
                                            <label for="customer_info">Customer Information</label>
                                        </div>
                                        <div style="padding: 10px;">
                                            <div style="margin-bottom: 10px;">
                                                <label for="CustomerName">Customer Name</label>
                                                <input type="text" class="form-control" id="CustomerName"
                                                    name="CustomerName" value="{{ $order->name ?? '' }}"
                                                    style="width: 100%;" readonly>
                                            </div>
                                            <div style="margin-bottom: 10px;">
                                                <label for="CustomerPhone">Customer Phone</label>
                                                <input type="text" class="form-control" id="CustomerPhone"
                                                    name="CustomerPhone" value="{{ $order->phone ?? '' }}"
                                                    style="width: 100%;" readonly>
                                            </div>
                                            <div style="margin-bottom: 10px;">
                                                <label for="CustomerAddress">Customer Address</label>
                                                <input type="text" class="form-control" id="CustomerAddress"
                                                    name="CustomerAddress" value="{{ $order->address ?? '' }}"
                                                    style="width: 100%;" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        style="border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); margin-bottom: 20px;">
                                        <div style="background-color: #f8f9fa; padding: 10px;">
                                            <label for="order_info">Order Information</label>
                                        </div>
                                        <?php
                                        $order_details = DB::table('order_details')
                                            ->join('orders', 'order_details.order_id', '=', 'orders.order_id')
                                            ->select('order_details.dish_name', 'order_details.dish_price', 'order_details.dish_qty')
                                            ->where('orders.order_id', $order->order_id)
                                            ->get();
                                        ?>
                                        @foreach ($order_details as $index => $order_detail)
                                            <div style="padding: 10px;">
                                                <label for="dish_info">Product {{ $index + 1 }}</label>
                                                <div style="margin-bottom: 10px;">
                                                    <label for="OrderName">Name</label>
                                                    <input type="text" class="form-control" id="OrderName"
                                                        name="OrderName" value="{{ $order_detail->dish_name ?? '' }}"
                                                        style="width: 100%;" readonly>
                                                </div>
                                                <div style="margin-bottom: 10px;">
                                                    <label for="Price">Price</label>
                                                    <input type="text" class="form-control" id="Price" name="Price"
                                                        value="{{ $order_detail->dish_price ?? '' }}" style="width: 100%;"
                                                        readonly>
                                                </div>
                                                <div style="margin-bottom: 10px;">
                                                    <label for="Quantity">Quantity</label>
                                                    <input type="text" class="form-control" id="Quantity"
                                                        name="Quantity" value="{{ $order_detail->dish_qty ?? '' }}"
                                                        style="width: 100%;" readonly>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if (Auth::user()->role == 1)
                                        <div style="text-align: center; margin-top: 10px;">
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
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

@endif
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
