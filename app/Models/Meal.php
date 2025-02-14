<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Meal extends Model
{
    protected $table = 'gericht';
    protected $primaryKey = 'id';  // Explicitly set primary key
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'beschreibung',
        'erfasst_am',
        'vegetarisch',
        'vegan',
        'preisintern',
        'preisextern',
        'bild_url',
        'rating'  // Add rating to fillable
    ];

    protected $casts = [
        'vegetarisch' => 'boolean',
        'vegan' => 'boolean',
        'erfasst_am' => 'date'
    ];

    public function ratings()
    {
        return $this->hasMany(MealRating::class, 'meal_id');
    }

    public function userRating()
    {
        if (!Auth::check()) {
            return null;
        }
        return $this->ratings()->where('user_id', Auth::user()->id)->first();
    }
}
