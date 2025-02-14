<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, $mealId)
    {
        $meal = Meal::findOrFail($mealId);
        
        $validated = $request->validate([
            'rating' => 'required|numeric|min:1|max:5'
        ]);

        // Store the rating using authenticated user's ID
        DB::table('meal_ratings')->updateOrInsert(
            [
                'meal_id' => $mealId,
                'user_id' => Auth::user()->id  // Use Auth facade
            ],
            [
                'rating' => $validated['rating'],
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // Calculate and update average rating in gericht table
        $avgRating = DB::table('meal_ratings')
            ->where('meal_id', $mealId)
            ->avg('rating');
            
        $meal->update(['rating' => round($avgRating, 1)]);

        return response()->json([
            'success' => true,
            'new_rating' => $meal->rating
        ]);
    }
}
