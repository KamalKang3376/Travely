<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\FlightBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class FlightBookingController extends Controller
{
    public function create($id)
    {
        $flight = Flight::where('status', true)
            ->where('departure_time', '>', now())
            ->findOrFail($id);

        if ($flight->available_seats < 1) {
            return redirect()->route('flights.index')
                ->with('error', 'Sorry, no seats are available.');
        }

        return view('flights.book', compact('flight'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'passengers' => 'required|integer|min:1|max:10',
        ]);

        $booking = DB::transaction(function () use ($validated, $id) {

            $flight = Flight::where('status', true)
                ->where('departure_time', '>', now())
                ->lockForUpdate()
                ->findOrFail($id);

            if ($flight->available_seats < $validated['passengers']) {
                throw ValidationException::withMessages([
                    'passengers' => 'Not enough seats are available for this flight.',
                ]);
            }

            $totalPrice = $flight->price * $validated['passengers'];

            $booking = FlightBooking::create([
                'booking_reference' => 'TRV' . strtoupper(Str::random(8)),
                'user_id' => Auth::id(),
                'flight_id' => $flight->id,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'passengers' => $validated['passengers'],
                'price_per_seat' => $flight->price,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            $flight->decrement('available_seats', $validated['passengers']);

            return $booking;
        });

        return redirect()->route(
            'flight-bookings.confirmation',
            $booking->booking_reference
        )->with('success', 'Your flight booking has been submitted successfully!');
    }

    public function confirmation($reference)
    {
        $booking = FlightBooking::with('flight')
            ->where('booking_reference', $reference)
            ->where(function ($query) {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                } else {
                    $query->whereNull('user_id');
                }
            })
            ->firstOrFail();

        return view('flights.confirmation', compact('booking'));
    }
    public function myBookings()
{
    $bookings = FlightBooking::with('flight')
        ->where('user_id', Auth::id())
        ->latest()
        ->paginate(10);

    return view('flight-bookings.index', compact('bookings'));
}

public function showMyBooking($reference)
{
    $booking = FlightBooking::with('flight')
        ->where('booking_reference', $reference)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    return view('flight-bookings.show', compact('booking'));
}

public function cancelMyBooking($reference)
{
    DB::transaction(function () use ($reference) {
        $booking = FlightBooking::where('booking_reference', $reference)
            ->where('user_id', Auth::id())
            ->lockForUpdate()
            ->firstOrFail();

        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            abort(403, 'This booking cannot be cancelled.');
        }

        $flight = Flight::lockForUpdate()->findOrFail($booking->flight_id);

        $flight->available_seats = min(
            $flight->total_seats,
            $flight->available_seats + $booking->passengers
        );

        $flight->save();

        $booking->update(['status' => 'cancelled']);
    });

    return redirect()->route('my-flight-bookings')
        ->with('success', 'Your flight booking has been cancelled.');
}
}
