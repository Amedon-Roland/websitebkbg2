<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GoogleMap extends Component
{
    public $latitude;
    public $longitude;
    public $apiKey;

    /**
     * Create a new component instance.
     *
     * @param float $latitude
     * @param float $longitude
     * @param string $apiKey
     */
    public function __construct($latitude, $longitude, $apiKey)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->apiKey = $apiKey;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.google-map');
    }
}
