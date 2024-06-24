<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Dish;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Coupon;
use Session;
use Cart;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function payment(){
        return \view('FrontEnd.checkout.checkout_payment');
    }

    public function order(Request $request){
        $payment_type =  $request->payment_type;
        if($payment_type == 'Cash'){
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->shipping_id = Session::get('shipping_id');
            $order->order_total = Session::get('sum') ;
            $order->save();

            $payment = new Payment();
            $payment->order_id = $order->order_id;
            $payment->payment_type = $payment_type;
            $payment->save();

            try {
                $coupon_left = Coupon::find(Session::get('coupon'));
                $coupon_left->coupon_number = $coupon_left->coupon_number - 1;
                $coupon_left->save();
            } catch (\Exception $e) {
                echo $e;
            }
            
            $cartProducts = Cart::content();
            foreach($cartProducts as $cartProduct){
                $orderDetails = new OrderDetail();
                $orderDetails->order_id = $order->order_id;
                $orderDetails->dish_id = $cartProduct->id;
                $orderDetails->dish_name = $cartProduct->name;
                $orderDetails->dish_price = $cartProduct->price;
                $orderDetails->dish_qty = $cartProduct->qty;
                Dish::where('dish_id',$cartProduct->id)->decrement('number_of_products',$cartProduct->qty);
                $orderDetails->save();
            }

            Cart::destroy();
            return \redirect('checkout/order/complete')->with('sms','Order completed successfully');
        }
        else{
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->shipping_id = Session::get('shipping_id');
            $order->order_total = Session::get('sum');
            $order->save();

            $payment = new Payment();
            $payment->order_id = $order->order_id;
            $payment->payment_type = $payment_type;
            $payment->save();

            
            $cartProducts = Cart::content();
            foreach($cartProducts as $cartProduct){
                $orderDetails = new OrderDetail();
                $orderDetails->order_id = $order->order_id;
                $orderDetails->dish_id = $cartProduct->id;
                $orderDetails->dish_name = $cartProduct->name;
                $orderDetails->dish_price = $cartProduct->price;
                $orderDetails->dish_qty = $cartProduct->qty;
                Dish::where('dish_id',$cartProduct->id)->decrement('number_of_products',$cartProduct->qty);
                $orderDetails->save();
            }

            Cart::destroy();
            return \redirect('checkout/order/complete')->with('sms','Order completed successfully');
        }
    }

    public function order_complete(){
        return \view('FrontEnd.checkout.checkout_complete');
    }

}