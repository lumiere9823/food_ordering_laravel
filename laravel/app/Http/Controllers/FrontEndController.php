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

        $categories = Category::where('category_status', 1)->get();

        return view('FrontEnd.include.home', compact('dishes','categories'));
    }
    public function dish_show(Request $request)
    {
        if ($request->has('dishes')) {
            $categoryDish = $request->dishes;
            return view('FrontEnd.include.dish', compact('categoryDish'));
        }
        $categoryDish = Dish::where('dish_status', 1)
                            ->where('category_id', $request->category_id)
                            ->get();
        if ($categoryDish->isEmpty()) {
            return view('FrontEnd.include.dish');
        }        
        return view('FrontEnd.include.dish', compact('categoryDish'));
    }

    public function search(Request $request)
    {
        $productName = $request->input('product_name');
        $categoryId = $request->input('category_id');
        $query = Dish::query();

        if (!empty($productName)) {
            $query->where('dish_name', 'like', '%' . $productName . '%')->where('dish_status', 1); 
        }

        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        $results = $query->get();

        if ($results->isEmpty()) {
            return view('FrontEnd.include.dish');
        }

        return $this->dish_show($request->merge(['category_id' => $categoryId, 'dishes' => $results]));
    }
}