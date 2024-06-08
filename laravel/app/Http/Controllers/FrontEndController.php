<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Support\Facades\Session;

class FrontEndController extends Controller
{
    public function index()
    {
        Session::put('previous_url', '/');
        if(Dish::all()->isEmpty()){
            view('FrontEnd.include.home');
        }
        $dishes = Dish::where('dish_status', 1)
              ->orderBy('created_at', 'desc')
              ->take(3)
              ->get();
        return view('FrontEnd.include.home', compact('dishes'));
    }
    public function dish_show(Request $request)
    {
        Session::put('previous_url', '/category/dish/show/'.$request->category_id);
        $categoryDish = Dish::where('dish_status', 1)
                            ->where('category_id', $request->category_id)
                            ->get();

        if ($categoryDish->isEmpty()) {
            return redirect()->back()->with('error', 'No dishes found for this category');
        }

        return view('FrontEnd.include.dish', compact('categoryDish'));
    }
}