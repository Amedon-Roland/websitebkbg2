<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProfileCard extends Component
{
    public $image;
    public $name;
    public $role;

    /**
     * Create a new component instance.
     *
     * @param string $image
     * @param string $name
     * @param string $role
     */
    public function __construct($image, $name, $role)
    {
        $this->image = $image;
        $this->name = $name;
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.profile-card');
    }
}
