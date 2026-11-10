<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::where('status', true)
            ->latest()
            ->paginate(9);

        return view('destinations.index', compact('destinations'));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('destinations.show', compact('destination'));
    }
}