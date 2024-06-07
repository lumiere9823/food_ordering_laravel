<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Shipping;
use Mail;
use Session;

class customerController extends Controller
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

        $data = $customer->toArray();

        Mail::send('FrontEnd.mail.welcome_mail',$data,function($message) use ($data){
            $message->to($data['email']);
            $message->subject('Welcome to our site');
        });

        return redirect()->route('sign_in')->with('sms','Customer created successfully');
    }

    public function post_sign_in(Request $request){

        dd($request->all());
        $customer = Customer::where('email',$request->email)->first();
        if($customer){
            if(password_verify($request->password,$customer->password)){
                Session::put('customer_id',$customer->id);
                Session::put('customer_name',$customer->name);
                return redirect()->route('checkout_payment');
            }else{
                return redirect()->back()->with('sms','Password is incorrect');
            }
        }else{
            return redirect()->back()->with('sms','Email is incorrect');
        }
    }

    public function shipping(){
        $customer = Customer::find(Session::get('customer_id'));
        return view('FrontEnd.checkout.shipping',compact('customer'));
    }

    public function store_shipping(Request $request){
        $shipping = new Shipping();
        $shipping->id = Session::get('customer_id');
        $shipping->name = $request->name;
        $shipping->email = $request->email;
        $shipping->phone = $request->phone;
        $shipping->address = $request->address;
        $shipping->save();

        Sesstion::put('customer_name',$shipping->name);

        return \redirect->route('checkout_payment');
    }
}
