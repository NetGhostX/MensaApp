<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        // c) Info for main page access
        $this->logger()->info('Accessing meals index page');
        $meals = Meal::paginate(9); // Show 9 meals per page
        return view('layouts.app', ['meals' => $meals]);
    }

    //aufgabe 3
    public function show($id)
    {
        $this->logger()->info('Viewing meal', ['id' => $id]);
    }
}
