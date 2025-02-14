<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealRating extends Model
{
    protected $table = 'meal_ratings';
    
    protected $fillable = [
        'meal_id',
        'user_id',
        'rating'
    ];

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }

    public function user()
    {
        return $this->belongsTo(Benutzer::class, 'user_id');
    }
}
