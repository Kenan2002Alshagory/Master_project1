<?php

namespace App\Http\Controllers;

use App\Http\Resources\FoodResource;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function allFood(Request $request){
        if($request->category == ''){
            return response()->json([
                'foods' => FoodResource::collection(Food::all())
            ]);
        }else if($request->category == 'Food'){
            return response()->json([
                'foods' => FoodResource::collection(Food::where('category_id',Category::where('name','Food')->first()->id)->get())
            ]);
        }else if($request->category == 'ColdDrink'){
            return response()->json([
                'foods' => FoodResource::collection(Food::where('category_id',Category::where('name','ColdDrink')->first()->id)->get())
            ]);
        }else if($request->category == 'HotDrink'){
            return response()->json([
                'foods' => FoodResource::collection(Food::where('category_id',Category::where('name','HotDrink')->first()->id)->get())
            ]);
        }
    }
    public function search(Request $request){
        if($request->category == ''){
            return response()->json([
                'foods' => FoodResource::collection(Food::where('name',"like","%".$request->name."%")->get())
            ]);
        }else if($request->category == 'Food'){
            return response()->json([
                'foods' => FoodResource::collection(Food::where('category_id',Category::where('name','Food')->first()->id)->where('name',"like","%".$request->name."%")->get())
            ]);
        }else if($request->category == 'ColdDrink'){
            return response()->json([
                'foods' => FoodResource::collection(Food::where('category_id',Category::where('name','ColdDrink')->first()->id)->where('name',"like","%".$request->name."%")->get())
            ]);
        }else if($request->category == 'HotDrink'){
            return response()->json([
                'foods' => FoodResource::collection(Food::where('category_id',Category::where('name','HotDrink')->first()->id)->where('name',"like","%".$request->name."%")->get())
            ]);
        }
    }
}
