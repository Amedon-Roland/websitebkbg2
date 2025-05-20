<?php

namespace App\View\Components;

use App\Models\RoomCategory;
use Illuminate\View\Component;

class RoomGalleryModal extends Component
{
    public $category;
    
    public function __construct(RoomCategory $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('components.room-gallery-modal');
    }
}
