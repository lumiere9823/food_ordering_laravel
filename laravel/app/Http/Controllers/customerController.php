<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Shipping;
use Mail;
use Session;

class CustomerController extends Controller
{
    public function show(){
        return view('FrontEnd.customer.register');
    }

    public function sign_in(){
        return view('FrontEnd.customer.login');
    }
    
    public function store(Request $request){
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->password = bcrypt($request->password);
        $customer->save();

        $customer_id = $customer->id;
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$customer->name);
        Session::put('customer_email',$customer->email);
        Session::put('customer_phone',$customer->phone);

        $data = $customer->toArray();

        Mail::send('FrontEnd.mail.welcome_mail',$data,function($message) use ($data){
            $message->to($data['email']);
            $message->subject('Welcome to our site');
        });

        return redirect()->route('shipping.show')->with('sms','Customer created successfully');
    }

    public function post_sign_in(Request $request){

        $customer = Customer::where('email',$request->email)->first();
        $previousUrl=$request->session()->get('previous_url');
        if($customer){
            if(password_verify($request->password,$customer->password)){
                Session::put('customer_id',$customer->id);
                Session::put('customer_name',$customer->name);
                Session::put('customer_email',$customer->email);
                Session::put('customer_phone',$customer->phone);
                return redirect($previousUrl)->with('sms','Login successfully');
            }else{
                return redirect($previousUrl)->with('sms','Password is incorrect');
            }
        }else{
            return redirect($previousUrl)->with('sms','Email is incorrect');
        }
    }

    public function shipping(){
        $customer = Customer::find(Session::get('customer_id'));
        return view('FrontEnd.checkout.shipping',compact('customer'));
    }

    public function store_shipping(Request $request){
        $customer_id = Session::get('customer_id');
    
        $customer_shipping = Shipping::where('id', $customer_id)->first();
    
        if($customer_shipping){
            $customer_shipping->address = $request->address;
            $customer_shipping->save();
            Session::put('shipping_id', $customer_shipping->id );
        }else{
            $shipping = new Shipping();
            $shipping->id = $customer_id;
            $shipping->name = Session::get('customer_name');
            $shipping->email = Session::get('customer_email');
            $shipping->phone = Session::get('customer_phone');
            $shipping->address = $request->address;
            $shipping->save();
            Session::put('shipping_id', $shipping->id );
        }
    
        Session::put('customer_name', $shipping->name ?? Session::get('customer_name'));
    
        return redirect()->route('checkout_payment');
    }
    
    public function logout(){
        Session::forget('customer_id');
        Session::forget('customer_name');
        Session::forget('customer_email');
        Session::forget('customer_phone');
        return redirect('/')->with('sms','Logout successfully');
    }

    public function couponApply(Request $request){
        $discountedAmount = $request->input('discountedAmount');
        session()->put('sum', $discountedAmount);
        return response()->json(['status' => 'success']);
    }
}