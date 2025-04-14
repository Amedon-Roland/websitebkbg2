<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClientList extends Component
{
    /**
     * Liste des liens d'images.
     *
     * @var array
     */
    public array $imageLinks;

    /**
     * Create a new component instance.
     *
     * @param array $imageLinks
     */
    public function __construct(array $imageLinks = [])
    {
        $this->imageLinks = $imageLinks;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client-list');
    }
}
