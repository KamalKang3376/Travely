<?php

namespace App\Http\Controllers;

use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::where('status', true)
            ->latest()
            ->paginate(9);

        return view('hotels.index', compact('hotels'));
    }

    public function show($slug)
    {
        $hotel = Hotel::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('hotels.show', compact('hotel'));
    }
}
