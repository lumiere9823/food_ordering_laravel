<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery_boy;

class deliveryBoyController extends Controller
{
    public function index(){
        return view('BackEnd.deliveryBoy.add');
    }

    public function save(Request $request){

        $deliveryBoy = new Delivery_boy();
        $deliveryBoy->delivery_boy_name = $request->delivery_boy_name;
        $deliveryBoy->delivery_boy_phone_number = $request->delivery_boy_phone_number;
        $deliveryBoy->delivery_boy_password = $request->delivery_boy_password;
        $deliveryBoy->added_on = $request->added_on;

        $deliveryBoy->save();

        return back()->with('sms','Saved Successfully');
    }

    public function manage(){
        $deliveryBoies = Delivery_boy::all();
        return view('BackEnd.deliveryBoy.manage',compact('deliveryBoies'));
    }

    public function edit($id)
    {
        $deliveryBoy = Delivery_boy::find($id);

        if (!$deliveryBoy) {
            return redirect()->route('manage_delivery_boy')->with('error', 'Delivery boy not found.');
        }

        return view('delivery_boys.edit', compact('deliveryBoy'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Add validation rules for delivery boy fields
        ]);

        $deliveryBoy = Delivery_boy::findOrFail($id);
        $deliveryBoy->update($request->all());

        return redirect()->route('manage_delivery_boy')->with('success', 'Delivery boy updated successfully.');
    }

    public function delete($id)
    {
        $deliveryBoy = Delivery_boy::find($id);

        if ($deliveryBoy) {
            $deliveryBoy->delete();
            return redirect()->route('manage_delivery_boy')->with('success', 'Delivery boy deleted successfully.');
        } else {
            return redirect()->route('manage_delivery_boy')->with('error', 'Delivery boy not found.');
        }
    }

    public function changeStatus($id)
    {
        $deliveryBoy = Delivery_boy::find($id);

        if (!$deliveryBoy) {
            return response()->json(['error' => 'Delivery boy not found'], 404);
        }

        $deliveryBoy->delivery_boy_status = $deliveryBoy->delivery_boy_status == 1 ? 0 : 1;
        $deliveryBoy->save();

        return response()->json(['delivery_boy_status' => $deliveryBoy->delivery_boy_status]);
    }

}