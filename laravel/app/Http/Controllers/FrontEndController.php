<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Dish;

class FrontEndController extends Controller
{
    public function index()
    {
        $dishes = Dish::where('dish_status', 1)->get();
        return view('FrontEnd.include.home', compact('dishes'));
    }
    public function dish_show(Request $request)
    {
        $categoryDish = Dish::where('dish_status', 1)
                            ->where('category_id', $request->category_id)
                            ->get();

        if ($categoryDish->isEmpty()) {
            return redirect()->back()->with('error', 'No dishes found for this category');
        }

        return view('FrontEnd.include.dish', compact('categoryDish'));
    }
}