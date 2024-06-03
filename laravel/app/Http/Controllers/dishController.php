<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use Illuminate\Validation\Rule;

class dishController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('BackEnd.dish.add', compact('categories'));
    }

    public function save(Request $request){
        $request->validate([
            'category_id' => ['required', Rule::exists('categories', 'category_id')],
            'dish_name' => 'required|string',
            'dish_detail' => 'required|string',
            'dish_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dish_status' => 'required|integer',
        ]);

        
        $dish = new Dish();
        
        $dish->category_id = $request->category_id;
        $dish->dish_name = $request->dish_name;
        $dish->dish_detail = $request->dish_detail;

        // Handle dish image upload
        if ($request->hasFile('dish_image')) {

            $image = $request->file('dish_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('dish_images'), $imageName);
            $dish->dish_image = $imageName;
        }
        
        $dish->dish_status = $request->dish_status;


        $dish->save();

        return back()->with('sms', 'Dish Saved');
    }
    
    public function manage(){
        $dishes = Dish::all();
        return view('BackEnd.dish.manage', compact('dishes'));
    }
    
    public function edit($id)
    {
        // Find the dish by its primary key
        $dish = Dish::find($id);
    
        // Check if the dish exists
        if (!$dish) {
            return redirect()->route('manage_dish')->with('error', 'Dish not found.');
        }
    
        return view('dishes.edit', compact('dish'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'name' => 'required|string|max:255',
            // Add other fields you want to validate
        ]);
    
        $dish = Dish::findOrFail($id);
    
        $dish->category_id = $request->category_id;
        $dish->dish_name = $request->dish_name;
        $dish->dish_detail = $request->dish_detail;
    
        // Handle dish image update
        if ($request->hasFile('dish_image')) {
            $image = $request->file('dish_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('dish_images'), $imageName);
            $dish->dish_image = $imageName;
        }
    
        $dish->dish_status = $request->dish_status;
        $dish->save();
    
        return redirect()->route('manage_dish')->with('success', 'Dish updated successfully.');
    }
    
    public function delete($id)
    {
        $dish = Dish::find($id);
    
        if ($dish) {
            // Delete dish image file from public directory
            if (file_exists(public_path('dish_images/' . $dish->dish_image))) {
                unlink(public_path('dish_images/' . $dish->dish_image));
            }
    
            $dish->delete();
            return redirect()->route('manage_dish')->with('success', 'Dish deleted successfully.');
        } else {
            return redirect()->route('manage_dish')->with('error', 'Dish not found.');
        }
    }
    
    public function changeStatus($id){
        $dish = Dish::find($id); 
    
        if(!$dish) {
            return response()->json(['error' => 'Dish not found'], 404);
        }
    
        $dish->dish_status = $dish->dish_status == 1 ? 0 : 1;
        $dish->save();
    
        return response()->json(['dish_status' => $dish->dish_status]);
    }
    
}