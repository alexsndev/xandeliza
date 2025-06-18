<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\SiteConfig;

class AppLayout extends Component
{
    public $headerColor;

    public function __construct()
    {
        $this->headerColor = SiteConfig::where('key', 'header_color')->value('value') ?? '#111827';
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
