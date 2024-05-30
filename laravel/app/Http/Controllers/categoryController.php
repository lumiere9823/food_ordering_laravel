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

}
