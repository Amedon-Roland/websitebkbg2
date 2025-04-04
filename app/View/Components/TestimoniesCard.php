<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestimoniesCard extends Component
{
    public string $date;
    public int $stars;
    public string $text;
    public string $image;
    public string $author;

    /**
     * Create a new component instance.
     */
    public function __construct(string $date, int $stars, string $text, string $image, string $author)
    {
        $this->date = $date;
        $this->stars = $stars;
        $this->text = $text;
        $this->image = $image;
        $this->author = $author;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.testimonies-card');
    }
}