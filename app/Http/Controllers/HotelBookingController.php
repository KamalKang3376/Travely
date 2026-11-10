<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\HotelBookingConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\HotelBookingCancellationMail;

class HotelBookingController extends Controller
{
    public function create($slug)
    {
        $hotel = Hotel::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('hotels.book', compact('hotel'));
    }

    public function store(Request $request, $slug)
    {
        $hotel = Hotel::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:20',
            'rooms' => 'required|integer|min:1|max:10',
        ]);

        $checkIn = \Carbon\Carbon::parse($validated['check_in']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out']);

        $nights = $checkIn->diffInDays($checkOut);

        $totalPrice = $hotel->price_per_night
            * $nights
            * $validated['rooms'];

        $booking = HotelBooking::create([
            'booking_reference' => 'TRV-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id(),
            'hotel_id' => $hotel->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'] ?? null,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'rooms' => $validated['rooms'],
            'price_per_night' => $hotel->price_per_night,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        try {
    $booking->load('hotel');

    Mail::to($booking->customer_email)
        ->send(new HotelBookingConfirmationMail($booking));

} catch (\Throwable $e) {
    Log::error('Travely booking email failed: ' . $e->getMessage());
}

        return redirect()
            ->route('hotel-bookings.confirmation', $booking->booking_reference)
            ->with('success', 'Your hotel booking has been submitted successfully.');
    }

    public function confirmation($reference)
    {
        $booking = HotelBooking::with('hotel')
            ->where('booking_reference', $reference)
            ->firstOrFail();

        if (
            $booking->user_id !== Auth::id()
            && $booking->customer_email !== Auth::user()?->email
        ) {
            abort(403);
        }

        return view('hotels.confirmation', compact('booking'));
    }
    
public function myBookings()
{
    $bookings = \App\Models\HotelBooking::with('hotel')
        ->where('user_id', auth()->id())
        ->latest()
        ->paginate(10);

    return view('bookings.index', compact('bookings'));
}


public function showMyBooking($reference)
{
    $booking = \App\Models\HotelBooking::with('hotel')
        ->where('booking_reference', $reference)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    return view('bookings.show', compact('booking'));
}

public function cancelMyBooking($reference)
{
    $booking = \App\Models\HotelBooking::where('booking_reference', $reference)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    if (!in_array($booking->status, ['pending', 'confirmed'])) {
        return back()->with('error', 'This booking cannot be cancelled.');
    }

    $booking->update([
        'status' => 'cancelled'
    ]);

    try {
    $booking->load('hotel');

    Mail::to($booking->customer_email)
        ->send(new HotelBookingCancellationMail($booking));

} catch (\Throwable $e) {
    Log::error('Travely cancellation email failed: ' . $e->getMessage());
}


    return redirect()
        ->route('my-bookings')
        ->with('success', 'Your booking has been cancelled successfully.');
}


}
