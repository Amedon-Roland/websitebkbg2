<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RoomCard extends Component
{
    public $image;
    public $title;
    public $availability;
    public $price;

    /**
     * Create a new component instance.
     */
    public function __construct($image, $title, $availability, $price)
    {
        $this->image = $image;
        $this->title = $title;
        $this->availability = $availability;
        $this->price = $price;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.room-card');
    }
}
