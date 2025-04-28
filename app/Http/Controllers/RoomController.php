<?php

namespace App\Http\Controllers;

use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::where('is_available', true)->get();
        return view('chambres', compact('rooms'));
    }
}
