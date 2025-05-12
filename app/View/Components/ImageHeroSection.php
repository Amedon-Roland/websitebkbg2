<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageHeroSection extends Component
{
    public string $backgroundImage;
    public string $title;
    public string $description;
    public bool $showScrollButton;
    public ?string $scrollTarget;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $backgroundImage,
        string $title,
        string $description,
        bool $showScrollButton,
        ?string $scrollTarget = null
    ) {
        $this->backgroundImage = $backgroundImage;
        $this->title = $title;
        $this->description = $description;
        $this->showScrollButton = $showScrollButton;
        $this->scrollTarget = $scrollTarget;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image-hero-section');
    }
}
