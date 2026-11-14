<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::where('status', true);

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('city', 'LIKE', "%{$search}%")
                    ->orWhere('country', 'LIKE', "%{$search}%");
            });
        }

        $hotels = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $hasFilters = $request->filled('search');

        return view('hotels.index', compact(
            'hotels',
            'hasFilters'
        ));
    }

    public function show($slug)
    {
        $hotel = Hotel::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('hotels.show', compact('hotel'));
    }
}
