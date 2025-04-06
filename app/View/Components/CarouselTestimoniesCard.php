<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CarouselTestimoniesCard extends Component
{
    public array $testimonies;

    /**
     * Create a new component instance.
     */
    public function __construct(array $testimonies)
    {
        $this->testimonies = $testimonies;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.carousel-testimonies-card');
    }
}
