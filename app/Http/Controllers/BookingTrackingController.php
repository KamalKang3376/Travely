<?php

namespace App\Http\Controllers;

use App\Models\PackageBooking;
use App\Models\FlightBooking;
use App\Models\HotelBooking;
use App\Models\DestinationBooking;
use App\Models\CarRentalBooking;
use Illuminate\Http\Request;

class BookingTrackingController extends Controller
{
    public function index()
    {
        return view('packages.track-booking');
    }

    public function track(Request $request)
    {
        $validated = $request->validate([
            'booking_reference' => 'required|string',
            'customer_email' => 'required|email',
        ]);

        $bookingTypes = [
            'package' => PackageBooking::class,
            'flight' => FlightBooking::class,
            'hotel' => HotelBooking::class,
            'destination' => DestinationBooking::class,
            'car' => CarRentalBooking::class,
        ];

        $booking = null;
        $bookingType = null;

        foreach ($bookingTypes as $type => $model) {
    $query = $model::query();

    if ($type === 'flight') {
        $query->with('flight');
    } elseif ($type === 'hotel') {
        $query->with('hotel');
    } elseif ($type === 'destination') {
        $query->with('destination');
    } elseif ($type === 'car') {
        $query->with('car');
    } elseif ($type === 'package') {
        $query->with('package');
    }

    $booking = $query
        ->where('booking_reference', trim($validated['booking_reference']))
        ->whereRaw(
            'LOWER(customer_email) = ?',
            [strtolower(trim($validated['customer_email']))]
        )
        ->first();

    if ($booking) {
        $bookingType = $type;
        break;
    }
}
        if (!$booking) {
            return back()
                ->withInput()
                ->withErrors([
                    'booking_reference' => 'No booking found with these details. Please check your reference and email.',
                ]);
        }

        return view(
            'packages.track-booking-result',
            compact('booking', 'bookingType')
        );
    }
}
