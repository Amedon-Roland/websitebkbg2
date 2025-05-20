<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\RoomCategory;

class ReservationForm extends Component
{
    public $compact;
    public $formAction;
    public $roomCategories;

    public function __construct($compact = false, $formAction = null, $roomCategories = null)
    {
        $this->compact = $compact;
        $this->formAction = $formAction ?? route('reservations.store');
        $this->roomCategories = $roomCategories ?? RoomCategory::all();
    }

    public function render()
    {
        return view('components.reservation-form');
    }
}
