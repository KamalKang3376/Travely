<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelBooking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HotelBookingController extends Controller
{
    public function index()
    {
        $bookings = HotelBooking::with('hotel')
            ->latest()
            ->paginate(10);

        return view('admin.hotel-bookings.index', compact('bookings'));
    }

    public function show($reference)
    {
        $booking = HotelBooking::with(['hotel', 'user'])
            ->where('booking_reference', $reference)
            ->firstOrFail();

        return view('admin.hotel-bookings.show', compact('booking'));
    }

    public function update(Request $request, $reference)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'confirmed',
                    'cancelled',
                    'completed',
                ]),
            ],
        ]);

        $booking = HotelBooking::where('booking_reference', $reference)
            ->firstOrFail();

        $booking->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.hotel-bookings.show', $booking->booking_reference)
            ->with('success', 'Booking status updated successfully!');
    }
}
