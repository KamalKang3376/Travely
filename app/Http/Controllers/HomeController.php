<?php

namespace App\Http\Controllers;

use App\Models\Destination;

class HomeController extends Controller
{
    public function index()
    {
        $destinations = Destination::where('status', true)
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('destinations'));
    }
}