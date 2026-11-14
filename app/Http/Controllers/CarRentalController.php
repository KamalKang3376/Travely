<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarRentalController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::where('status', true);

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where('name', 'LIKE', "%{$search}%");
        }

        if ($request->filled('seats')) {
            $query->where('seats', $request->seats);
        }

        $cars = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $seatOptions = Car::where('status', true)
            ->whereNotNull('seats')
            ->distinct()
            ->orderBy('seats')
            ->pluck('seats');

        $hasFilters = $request->filled('search')
            || $request->filled('seats');

        return view('cars.index', compact(
            'cars',
            'seatOptions',
            'hasFilters'
        ));
    }

    public function show($slug)
    {
        $car = Car::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('cars.show', compact('car'));
    }
}
