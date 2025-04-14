<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ExploreHero extends Component
{
    public string $videoUrl;
    public bool $autoplay;
    public bool $muted;
    public bool $loop;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $videoUrl,
        bool $autoplay = false,
        bool $muted = true,
        bool $loop = true
    ) {
        $this->videoUrl = $videoUrl;
        $this->autoplay = $autoplay;
        $this->muted = $muted;
        $this->loop = $loop;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.explore-hero');
    }
}