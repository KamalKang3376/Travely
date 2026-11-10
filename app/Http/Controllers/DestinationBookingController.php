<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DestinationBookingController extends Controller
{
    public function create($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('destinations.book', compact('destination'));
    }

    public function store(Request $request, $slug)
    {
        $destination = Destination::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'travellers' => 'required|integer|min:1|max:20',
        ]);

        $pricePerPerson = (float) $destination->starting_price;
        $totalPrice = $pricePerPerson * $validated['travellers'];

        $booking = DestinationBooking::create([
            'booking_reference' => 'TRV-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id(),
            'destination_id' => $destination->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'travellers' => $validated['travellers'],
            'price_per_person' => $pricePerPerson,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        session()->put(
            'destination_booking_' . $booking->booking_reference,
            true
        );

        return redirect()
            ->route('destination-bookings.confirmation', $booking->booking_reference)
            ->with('success', 'Your destination booking has been submitted successfully!');
    }

    public function confirmation($reference)
    {
        $booking = DestinationBooking::with('destination')
            ->where('booking_reference', $reference)
            ->firstOrFail();

        $isOwner = (
            $booking->user_id !== null &&
            $booking->user_id === Auth::id()
        ) || session()->has('destination_booking_' . $reference);

        if (!$isOwner) {
            abort(403);
        }

        return view('destinations.confirmation', compact('booking'));
    }
    
    public function myBookings()
    {
        $bookings = DestinationBooking::with('destination')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('destination-bookings.index', compact('bookings'));
    }

    public function showMyBooking($reference)
    {
        $booking = DestinationBooking::with('destination')
            ->where('booking_reference', $reference)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('destination-bookings.show', compact('booking'));
    }

    public function cancelMyBooking($reference)
    {
        $booking = DestinationBooking::where('booking_reference', $reference)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'This booking cannot be cancelled.');
        }

        $booking->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('my-destination-bookings')
            ->with('success', 'Destination booking cancelled successfully!');
    }

}
