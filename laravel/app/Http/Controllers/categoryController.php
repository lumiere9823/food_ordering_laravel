<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class categoryController extends Controller
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

        return back()->with('sms','Category Saved');

    }

    public function manage(){
        $categories = Category::all();
        return view('BackEnd.category.manageCategory',compact('categories'));
    }

    public function edit($id){
        $category = Category::find($id);
        return view('BackEnd.category.editCategory', compact('category'));
    }

    public function delete($id){
        Category::destroy($id);
        return redirect()->route('category.manage')->with('success', 'Category deleted successfully');
    }

    public function changeStatus($id){
        $category = Category::find($id);
        if($category->category_status == 1){
            $category->category_status = 0;
        }else{
            $category->category_status = 1;
        }
        $category->save();
        return response()->json(['message' => 'Category status changed successfully']);
    }

}