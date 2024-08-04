<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFoodRequest;
use App\Http\Requests\EditFoodRequest;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodsController extends Controller
{
    public function addFood(AddFoodRequest $request){

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', ['disk' =>'my_files']);
        }
        $category =  $category = Category::firstOrCreate(
            ['name' => $request->category],  // Attributes to search for
            ['name' => $request->category]   // Attributes to set if creating
        );
        $food = Food::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $category->id,
            'photo' => $path,
        ]);
        return response()->json([
            'message' => 'the food created',
            'food' => $food
        ]);
    }

    public function editFood(EditFoodRequest $request,$FoodId){
        $food = Food::find($FoodId);
        if (!$food) {
            return response()->json(['message' => 'Food not found'], 404);
        }
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', ['disk' =>'my_files']);
            $food->update(['photo'=>$path]);
        }
        $food->update($request->only([
            'name','description','price'
        ]));
        return response()->json([
            'message' => 'your Food updated',
            'food' => $food
        ]);
    }

    public function deleteFood($FoodId){
        Food::find($FoodId)->delete();
        return response()->json([
            'message' => 'your Food deleted',
        ]);

    }
}
