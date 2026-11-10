<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarRentalBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CarRentalBookingController extends Controller
{
    public function index()
    {
        $bookings = CarRentalBooking::with(['car', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.car-rental-bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = CarRentalBooking::with(['car', 'user'])
            ->findOrFail($id);

        return view('admin.car-rental-bookings.show', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        DB::transaction(function () use ($request, $id) {

            $booking = CarRentalBooking::whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($request->status === 'confirmed') {

                $car = $booking->car()
                    ->lockForUpdate()
                    ->firstOrFail();

                $overlap = CarRentalBooking::where('car_id', $car->id)
                    ->where('id', '!=', $booking->id)
                    ->whereIn('status', ['pending', 'confirmed'])
                    ->where('pickup_datetime', '<', $booking->return_datetime)
                    ->where('return_datetime', '>', $booking->pickup_datetime)
                    ->exists();

                if ($overlap) {
                    throw ValidationException::withMessages([
                        'status' => 'This car already has another booking during these dates.',
                    ]);
                }
            }

            $booking->update([
                'status' => $request->status,
            ]);
        });

        return redirect()
            ->route('admin.car-rental-bookings.show', $id)
            ->with('success', 'Car rental booking status updated successfully.');
    }
}