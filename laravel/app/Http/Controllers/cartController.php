<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Coupon;
use Cart;
use Carbon\Carbon;

class CartController extends Controller
{
    public function insert(Request $request){
        $dish = Dish::findOrFail($request->dish_id);
    
        Cart::add([
            'id' => $request->dish_id, 
            'name' => $dish->dish_name,
            'qty' => $request->qty, 
            'price' => $request->half_price_value ? $dish->half_price : $dish->full_price,
            'options' => ['dish_image' => $dish->dish_image]
        ]);
    
        return redirect()->back()->with('sms','Added to cart successfully');
    }
    

    public function show(){
        $current = Carbon::now();
        $coupons = Coupon::where('coupon_status', 1,)
                            ->where('expire_on', '>', $current)
                            ->get();
        $CartDish = Cart::content();
        return view('FrontEnd.cart.show',compact('CartDish','coupons'));
    }

    public function remove(Request $request){
        Cart::remove($request->rowId);
        return redirect()->route('cart_show')->with('sms','Item removed from cart successfully');
    }

    public function updateQuantity(Request $request) {
        $rowId = $request->rowId;
        $action = $request->action;
        $item = Cart::get($rowId);
    
        if ($action === 'increase') {
            Cart::update($rowId, $item->qty + 1);
        } elseif ($action === 'decrease') {
            if ($item->qty > 1) {
                Cart::update($rowId, $item->qty - 1);
            }
        }
    
        $newItem = Cart::get($rowId);
    
        return response()->json([
            'qty' => $newItem->qty,
        ]);
    }
    

}