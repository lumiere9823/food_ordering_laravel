@extends('layouts.app-master')

@section('content')
    <div class="content-wrapper">
        @if (Session::get('sms'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('sms') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <section class="content container">
            <div class="row justify-content-center">
                @foreach ($orders as $index => $order)
                    <div class="mb-3">
                        <div class="card"
                            style="cursor: pointer; border: 1px solid #ccc; border-radius: 12px; padding: 10px;background-color: #f8f9fa;"
                            data-toggle="modal" data-target="#orderDetailModal{{ $order->order_id }}">
                            <div class="card-header" style=" padding-top: 4px;">
                                <h5>Order #{{ $index + 1 }}</h5>
                            </div>
                            <hr style="border-color: black;">
                            <div class="card-body">
                                <p><strong>Customer Name:</strong> {{ $order->name }}</p>
                                <p><strong>Order Total:</strong> {{ $order->order_total }}</p>
                                <p><strong>Order Status:</strong> {{ $order->order_status }}</p>
                                <p><strong>Cusomer Address:</strong> {{ $order->address }}</p>
                                <p><strong>Payment Type:</strong> {{ $order->payment_type }}</p>
                                <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
                            </div>
                            <form method="POST" action="{{ route('update_status', $order->order_id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Mark as Completed</button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal for Order Details -->
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
                                                <label for="dish_info">Dish {{ $index + 1 }}</label>
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
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
