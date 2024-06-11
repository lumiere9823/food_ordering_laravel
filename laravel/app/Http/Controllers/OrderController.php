<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class OrderController extends Controller
{
    public function manageOrder()
    {

        $orders = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('payments', 'orders.order_id', '=', 'payments.order_id')
            ->join('shippings', 'orders.shipping_id', '=', 'shippings.id')
            ->select(
                'orders.*',
                'customers.name',
                'payments.payment_type',
                'payments.payment_status',
                'shippings.*',
            )
            ->get();

        return view('BackEnd.order.manage', compact('orders'));
    }

    public function deleteOrder($id)
    {
        DB::table('orders')->where('order_id', $id)->delete();
        DB::table('payments')->where('order_id', $id)->delete();
        DB::table('order_details')->where('order_id', $id)->delete();

        Session::put('sms', 'Order Deleted Successfully');
        return redirect()->back();
    }
}