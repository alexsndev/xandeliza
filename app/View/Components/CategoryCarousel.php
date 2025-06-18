<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class CategoryCarousel extends Component
{
    public $categories;

    public function __construct()
    {
        $this->categories = Category::orderBy('order')->get();
    }

    public function render()
    {
        return view('components.category-carousel');
    }
} 