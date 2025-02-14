<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Contracts\View\View as ViewContract;
use Closure;
use App\Models\Meal;

class MealCard extends Component
{
    /**
     * The meal to display
     */
    public $meal;

    /**
     * Create a new component instance.
     */
    public function __construct(Meal $meal)
    {
        $this->meal = $meal;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): ViewContract|Closure|string
    {
        return view('components.meal-card');
    }
}
