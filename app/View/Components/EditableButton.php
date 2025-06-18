<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\SiteConfig;

class EditableButton extends Component
{
    public $configKey;
    public $color;
    public $section;
    public $class;
    public $type;

    public function __construct($configKey, $section = 'general', $class = '', $type = 'button')
    {
        $this->configKey = $configKey;
        $this->section = $section;
        $this->class = $class;
        $this->type = $type;
        $this->color = SiteConfig::where('key', $configKey)->value('value')
            ?? SiteConfig::where('key', 'primary_button_color')->value('value')
            ?? '#111827';
    }

    public function render()
    {
        return view('components.editable-button');
    }
} 