<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactForm extends Component
{
    public string $fullname;
    public string $email;
    public string $message;

    /**
     * Create a new component instance.
     */
    public function __construct(string $fullname = '', string $email = '', string $message = '')
    {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact-form');
    }
}
