<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InstallationCard extends Component
{
    public $icon;
    public $title;

    /**
     * Create a new component instance.
     */
    public function __construct($icon, $title)
    {
        $this->icon = $icon;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.installation-card');
    }
}
