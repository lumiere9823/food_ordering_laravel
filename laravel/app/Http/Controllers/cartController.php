<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use Cart;

class cartController extends Controller
{
    public function insert(Request $request){
        $dish = Dish::find($request->dish_id)->first();

        Cart::add([
            'id' => $request->dish_id, 
            'qty' => $request->qty, 
            'name' => $dish->name ,
            'full_price' => $dish->full_price , 
            'weight'=>550,
            'option'=> [
                'half_price' => $dish->half_price,
                'image' => $dish->dish_image,
            ],
            ]);
        return redirect()->route('cart_show')->with('sms','Added to cart successfully');
    }

    public function show(){
        $CartDish = Cart::content();
        return view('FrontEnd.cart.show',compact('CartDish'));
    }

}
