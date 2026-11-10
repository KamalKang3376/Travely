<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::where('status', true)
            ->where('departure_time', '>', now())
            ->where('available_seats', '>', 0);

        if ($request->filled('departure_city')) {
            $query->where('departure_city', 'LIKE', '%' . $request->departure_city . '%');
        }

        if ($request->filled('arrival_city')) {
            $query->where('arrival_city', 'LIKE', '%' . $request->arrival_city . '%');
        }

        if ($request->filled('departure_date')) {
            $query->whereDate('departure_time', $request->departure_date);
        }

        $flights = $query->orderBy('departure_time')
            ->paginate(9)
            ->withQueryString();

        return view('flights.index', compact('flights'));
    }

    public function show($id)
    {
        $flight = Flight::where('status', true)
            ->where('departure_time', '>', now())
            ->findOrFail($id);

        return view('flights.show', compact('flight'));
    }
}
