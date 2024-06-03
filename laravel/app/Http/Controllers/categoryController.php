<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        return view('BackEnd.category.addCategory');
    }

    public function save(Request $request){

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->order_number = $request->order_number;
        $category->category_status = $request->status;
        $category->added_on = $request->added_on;

        $category->save();

        return redirect('/category/manage')->with('sms','Category Saved');
    }

    public function manage(){
        $categories = Category::all();
        return view('BackEnd.category.manageCategory',compact('categories'));
    }

    public function edit($id)
    {
        // Find the category by its primary key
        $category = Category::find($id);

        // Check if the category exists
        if (!$category) {
            return redirect()->route('manage_cate')->with('error', 'Category not found.');
        }

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'name' => 'required|string|max:255',
            // Add other fields you want to validate
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('manage_cate')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return redirect()->route('manage_cate')->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->route('manage_cate')->with('error', 'Category not found.');
        }
    }

    public function changeStatus($id){
        $category = Category::find($id); 
    
        if(!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    
        $category->category_status = $category->category_status == 1 ? 0 : 1;
        $category->save();
    
        return response()->json(['category_status' => $category->category_status]);
    }
    
}