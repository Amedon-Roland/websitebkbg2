<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;

class RoomController extends Controller
{
    public function index()
    {
        $categories = RoomCategory::all();
        return view('chambres', compact('categories'));
    }
}
