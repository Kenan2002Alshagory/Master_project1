<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReviewRequest;
use App\Models\Food;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function addReview(AddReviewRequest $request){
        $user = Auth::user();


        if ($user->reviews()->where('food_id', $request->food_id)->exists()) {
            return response()->json([
                'message' => 'You have already reviewed this food'
            ], 400);
        }

        // Attach the review
        $user->food()->attach($request->food_id, ['rate' => $request->rate]);

        return response()->json([
            'message' => 'Review added successfully'
        ], 201);
    }

    public function deleteReview($food_id){
        $user = Auth::user();

        // Find the review by the authenticated user and the food ID
        $review = Review::where('user_id', $user->id)
                        ->where('food_id', $food_id)
                        ->first();

        if ($review) {
            // Delete the review
            $review->delete();
            return response()->json([
                'message' => 'Review deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Review not found'
            ], 404);
        }
    }

    public function reviewForFood($food_id){
        return response()->json([
            'reviews' => Food::find($food_id)->user
        ]);
    }
}
