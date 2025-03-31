<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RoomCardDesc extends Component
{
    public $image;
    public $label;
    public $description;

    /**
     * Create a new component instance.
     */
    public function __construct($image, $label, $description)
    {
        $this->image = $image;
        $this->label = $label;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.room-card-desc');
    }
}
