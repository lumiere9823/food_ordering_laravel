<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shipping;
use App\Models\Role;
use Mail;
use Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function save(){
        $roles = Role::whereNot('id', 3)->get();
        return view("BackEnd.user.add",compact('roles'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('login');
    }

    public function manage(){
        $users = User::whereNot('role', 1)->get();
        $roles = Role::all();
        return view("BackEnd.user.manage",compact('users','roles'));
    }

    public function edit($id){
        $user = User::find($id);
        $roles = Role::all();
        return view("BackEnd.user.edit",compact('user','roles'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'phone' => 'required',
        ]);
        try {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->phone = $request->phone;
            $user->save();
        } catch (\Exception $e) {
            echo $e;
        }
        return redirect()->route('manage_user')->with('success', 'Category updated successfully.');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }

    public function shipping(){
        $customer = Auth::user();
        return view('FrontEnd.checkout.shipping',compact('customer'));
    }

    public function store_shipping(Request $request){
        $user_id = Auth::user()->id;
    
        $customer_shipping = Shipping::where('id', $user_id)->first();
    
        if($customer_shipping){
            $customer_shipping->address = $request->address;
            $customer_shipping->save();
            Session::put('shipping_id', $customer_shipping->id );
        }else{
            $shipping = new Shipping();
            $shipping->id = $user_id;
            $shipping->name = Auth::user()->name;
            $shipping->email = Auth::user()->email;
            $shipping->phone = Auth::user()->phone;
            $shipping->address = $request->address;
            $shipping->save();
            Session::put('shipping_id', $shipping->id );
        }
    
        return redirect()->route('checkout_payment');
    }

    public function couponApply(Request $request){
        $discountedAmount = $request->input('discountedAmount');
        session()->put('sum', $discountedAmount);
        return response()->json(['status' => 'success']);
    }
}