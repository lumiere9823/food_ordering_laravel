<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderDetail;
use DB;
use Auth;
use Session;

class OrderController extends Controller
{
    public function manageOrderAdmin()
    {
        if(Auth::user()->role !== 2)
        {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('payments', 'orders.order_id', '=', 'payments.order_id')
            ->join('shippings', 'orders.shipping_id', '=', 'shippings.id')
            ->select(
                'orders.*',
                'users.name',
                'payments.payment_type',
                'payments.payment_status',
                'shippings.*',
            )
            ->get();

        return view('BackEnd.order.manage', compact('orders'));
        }
        else
        {
            return redirect()->back();
        }
    }
    
    public function manageOrderShipper()
    {
        if(Auth::user()->role == 2)
        {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('payments', 'orders.order_id', '=', 'payments.order_id')
            ->join('shippings', 'orders.shipping_id', '=', 'shippings.id')
            ->select(
                'orders.*',
                'users.name',
                'payments.payment_type',
                'payments.payment_status',
                'shippings.*',
            )
            ->where('orders.shipper_id', null)
            ->get();
        return view('BackEnd.shipper.manage', compact('orders'));
        }
        else
        {
            return redirect()->back();
        }
    }
    
    public function manageOrderSelfShipper()
    {
        $id = Auth::user()->id;
        if(Auth::user()->role == 2)
        {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('payments', 'orders.order_id', '=', 'payments.order_id')
            ->join('shippings', 'orders.shipping_id', '=', 'shippings.id')
            ->select(
                'orders.*',
                'users.name',
                'payments.payment_type',
                'payments.payment_status',
                'shippings.*',
            )
            ->where('orders.shipper_id', $id)
            ->get();

        return view('BackEnd.shipper.shipper_order', compact('orders'));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function deleteOrder($id)
    {
        $orders = OrderDetail::where('order_id',$id)->get();
        foreach($orders as $order){
            $dish = Dish::where('dish_id',$order->dish_id)->first();
            $dish->number_of_products = $dish->number_of_products + $order->dish_qty;
            $dish->save();
        }
        DB::table('orders')->where('order_id', $id)->delete();
        DB::table('payments')->where('order_id', $id)->delete();
        DB::table('order_details')->where('order_id', $id)->delete();

        Session::put('sms', 'Order Deleted Successfully');
        return redirect()->back();
    }

    public function acceptOrder($id)
    {
        $shipper_id = Auth::user()->id;
        DB::table('orders')->where('order_id', $id)->update(['shipper_id' => $shipper_id, 'order_status' => 'accepted']);

        Session::put('sms', 'Order Accepted Successfully');
        return redirect()->back();
    } 

    public function updateStatus($id)
{
    DB::table('orders')->where('order_id', $id)->update(['order_status' => 'completed']);

    // $paymentType = DB::table('payments')->where('order_id', $id)->value('payment_type');

    // if ($paymentType.equalToIgnoringCase('Cash')) {
    //     DB::table('payments')->where('order_id', $id)->update(['payment_status' => 'completed']);
    // }

    Session::put('sms', 'Order Status Updated Successfully');
    return redirect()->back();
}


}