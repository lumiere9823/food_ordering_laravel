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
        <div class="row justify-content-center" style="position: relative">
            <div style=" border:solid white 1px; border-radius:12px; padding: 20px; background: white">
                <!-- Allocate six columns for the form -->
                <div class="card">
                    <div class="card-header">
                        <h3>Datatable for dish</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Order Total</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Payment Type </th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $index => $order)
                                <tr style="text-align:center">
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->order_total }}</td>
                                    <td>{{ $order->order_status }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                style="min-width:100px; padding:8px">
                                                <div style="text-align: center;">
                                                    <button type="button" class="btn btn-warning" style="width: 80%;"
                                                        data-toggle="modal"
                                                        data-target="#orderDetailModal{{ $order->order_id }}">
                                                        Detail
                                                    </button>
                                                </div>
                                                <div
                                                    style="text-align: center; margin-top: 10px;min-width:100px; padding:8px">
                                                    <form method="POST"
                                                        action="{{ route('delete_order', $order->order_id) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button id="deleteOrderBtn_{{ $order->order_id }}"
                                                            class="btn btn-danger show_confirm" style="width: 80%;"
                                                            data-toggle="tooltip" title='Delete'>Delete</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="orderDetailModal{{ $order->order_id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="orderDetailModalLabel{{ $order->order_id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="border-radius: 16px">
                                            <div class="modal-header"
                                                style="background: #ccc;border-top-left-radius: 16px;border-top-right-radius: 16px ;display: flex; justify-content: space-between;">
                                                <h1 class="modal-title" style="font-weight: 700;"
                                                    id="orderDetailModalLabel{{ $order->order_id }}">Order Detail
                                                </h1>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
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
                                                                style="width: 100%;">
                                                        </div>
                                                        <div style="margin-bottom: 10px;">
                                                            <label for="CustomerPhone">Customer Phone</label>
                                                            <input type="text" class="form-control" id="CustomerPhone"
                                                                name="CustomerPhone" value="{{ $order->phone ?? '' }}"
                                                                style="width: 100%;">
                                                        </div>
                                                        <div style="margin-bottom: 10px;">
                                                            <label for="CustomerAddress">Customer Address</label>
                                                            <input type="text" class="form-control" id="CustomerAddress"
                                                                name="CustomerAddress"
                                                                value="{{ $order->address ?? '' }}"
                                                                style="width: 100%;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    style="border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); margin-bottom: 20px;">
                                                    <div style="background-color: #f8f9fa; padding: 10px;">
                                                        <label for="customer_info">Order Information</label>
                                                    </div>
                                                    <?php
                                                    $order_details = DB::table('order_details')    
                                                    ->join('orders', 'order_details.order_id', '=', 'orders.order_id')
                                                    ->select(
                                                        'order_details.dish_name',
                                                        'order_details.dish_price',
                                                        'order_details.dish_qty'
                                                    )
                                                    ->where('orders.order_id', $order->order_id)
                                                    ->get();
                                                    ?>
                                                    @foreach ($order_details as $index => $order_detail)
                                                    <div
                                                        style="border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); margin-bottom: 20px;">
                                                        <div style="padding: 10px;">
                                                            <label for="customer_info">Dish
                                                                {{ $index + 1 }}</label>
                                                            <div style="margin-bottom: 10px;">
                                                                <label for="OrderName">Name</label>
                                                                <input type="text" class="form-control" id="OrderName"
                                                                    name="OrderName"
                                                                    value="{{ $order_detail->dish_name ?? '' }}"
                                                                    style="width: 100%;">
                                                            </div>
                                                            <div style="margin-bottom: 10px;">
                                                                <label for="Price">Price</label>
                                                                <input type="text" class="form-control" id="Price"
                                                                    name="Price"
                                                                    value="{{ $order_detail->dish_price ?? '' }}"
                                                                    style="width: 100%;">
                                                            </div>
                                                            <div style="margin-bottom: 10px;">
                                                                <label for="CustomerAddress">Quantity</label>
                                                                <input type="text" class="form-control"
                                                                    id="CustomerAddress" name="CustomerAddress"
                                                                    value="{{ $order_detail->dish_qty ?? '' }}"
                                                                    style="width: 100%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection