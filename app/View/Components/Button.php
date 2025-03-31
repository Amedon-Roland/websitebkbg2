<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $width;
    public $height;
    public $cornerRadius;

    public $fontweight;

    /**
     * Create a new component instance.
     */
    public function __construct($width = '165px', $height = '55px', $cornerRadius = '5px', $fontweight = '0')
    {
        $this->width = $width;
        $this->height = $height;
        $this->cornerRadius = $cornerRadius;
        $this->fontweight = $fontweight;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.button');
    }
}
