<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DestinationBooking;
use Illuminate\Http\Request;

class DestinationBookingController extends Controller
{
    public function index()
    {
        $bookings = DestinationBooking::with(['destination', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.destination-bookings.index', compact('bookings'));
    }

    public function show($reference)
    {
        $booking = DestinationBooking::with(['destination', 'user'])
            ->where('booking_reference', $reference)
            ->firstOrFail();

        return view('admin.destination-bookings.show', compact('booking'));
    }

    public function update(Request $request, $reference)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $booking = DestinationBooking::where(
            'booking_reference',
            $reference
        )->firstOrFail();

        $booking->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.destination-bookings.show', $booking->booking_reference)
            ->with('success', 'Destination booking status updated successfully!');
    }
}
