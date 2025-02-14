<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    protected $table = 'allergen';
    protected $primaryKey = 'code';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'typ'
    ];

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'gericht_hat_allergen', 'code', 'gericht_id');
    }
}
