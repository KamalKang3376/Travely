<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::where('status', true);

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('city', 'LIKE', "%{$search}%")
                    ->orWhere('country', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        $destinations = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $countries = Destination::where('status', true)
            ->whereNotNull('country')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');

        $hasFilters = $request->filled('search')
            || $request->filled('country');

        return view('destinations.index', compact(
            'destinations',
            'countries',
            'hasFilters'
        ));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('destinations.show', compact('destination'));
    }
}
