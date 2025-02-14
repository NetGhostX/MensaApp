<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'kategorie';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'eltern_id',
        'bildname'
    ];

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'gericht_hat_kategorie', 'kategorie_id', 'gericht_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'eltern_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'eltern_id');
    }
}
