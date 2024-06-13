<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Dish;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class FrontEndController extends Controller
{
    public function index()
    {
        Session::put('previous_url', '/');
        if(Dish::all()->isEmpty()){
            view('FrontEnd.include.home');
        }
        $results = DB::select('
            SELECT 
                dish_id, 
                SUM(dish_qty) AS total_qty 
            FROM 
                order_details 
            GROUP BY 
                dish_id 
            ORDER BY 
                total_qty DESC 
            LIMIT 6
        ');
        $dishes = [];
        foreach ($results as $topDish) {
            $dish = Dish::find($topDish->dish_id);
            if ($dish) {
                $dish->total_qty = $topDish->total_qty;
                $dishes[] = $dish;
            }
        }

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