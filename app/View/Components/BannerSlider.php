<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BannerSlider extends Component
{
    public $banners;

    public function __construct($banners)
    {
        $this->banners = $banners;
    }

    public function render()
    {
        return view('components.banner-slider');
    }
} 