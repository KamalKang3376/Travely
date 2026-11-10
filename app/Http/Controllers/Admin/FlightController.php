<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::latest()->paginate(10);

        return view('admin.flights.index', compact('flights'));
    }

    public function create()
    {
        return view('admin.flights.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'airline' => 'required|string|max:255',
            'flight_number' => 'required|string|max:50|unique:flights,flight_number',
            'departure_city' => 'required|string|max:255',
            'arrival_city' => 'required|string|max:255',
            'departure_airport' => 'nullable|string|max:255',
            'arrival_airport' => 'nullable|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
            'total_seats' => 'required|integer|min:1',
            'travel_class' => 'required|in:Economy,Business,First Class',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $validated['available_seats'] = $validated['total_seats'];

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('flights', 'public');
        }

        Flight::create($validated);

        return redirect()->route('admin.flights.index')
            ->with('success', 'Flight added successfully!');
    }

    public function show(Flight $flight)
    {
        return redirect()->route('admin.flights.index');
    }

    public function edit(Flight $flight)
    {
        return view('admin.flights.edit', compact('flight'));
    }

    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'airline' => 'required|string|max:255',
            'flight_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('flights', 'flight_number')->ignore($flight->id),
            ],
            'departure_city' => 'required|string|max:255',
            'arrival_city' => 'required|string|max:255',
            'departure_airport' => 'nullable|string|max:255',
            'arrival_airport' => 'nullable|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
            'total_seats' => 'required|integer|min:1',
            'travel_class' => 'required|in:Economy,Business,First Class',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($flight->image) {
                Storage::disk('public')->delete($flight->image);
            }

            $validated['image'] = $request->file('image')->store('flights', 'public');
        }

        $flight->update($validated);

        return redirect()->route('admin.flights.index')
            ->with('success', 'Flight updated successfully!');
    }

    public function destroy(Flight $flight)
    {
        if ($flight->bookings()->exists()) {
            return back()->with('error', 'This flight cannot be deleted because bookings already exist.');
        }

        if ($flight->image) {
            Storage::disk('public')->delete($flight->image);
        }

        $flight->delete();

        return redirect()->route('admin.flights.index')
            ->with('success', 'Flight deleted successfully!');
    }
}
