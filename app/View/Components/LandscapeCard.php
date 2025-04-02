<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LandscapeCard extends Component
{
    public $image;
    public $title;
    public $description;

    /**
     * Create a new component instance.
     */
    public function __construct($image, $title, $description)
    {
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.landscape-card');
    }
}
