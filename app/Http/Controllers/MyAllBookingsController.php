<?php

namespace App\Http\Controllers;

use App\Models\HotelBooking;
use App\Models\DestinationBooking;
use App\Models\FlightBooking;
use App\Models\PackageBooking;
use App\Models\CarRentalBooking;

class MyAllBookingsController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $hotelBookings = HotelBooking::where('user_id', $userId)
            ->latest()
            ->get();

        $destinationBookings = DestinationBooking::where('user_id', $userId)
            ->latest()
            ->get();

        $flightBookings = FlightBooking::where('user_id', $userId)
            ->latest()
            ->get();

        $packageBookings = PackageBooking::where('user_id', $userId)
            ->latest()
            ->get();

        $carBookings = CarRentalBooking::where('user_id', $userId)
            ->latest()
            ->get();

        $totalBookings = $hotelBookings->count()
            + $destinationBookings->count()
            + $flightBookings->count()
            + $packageBookings->count()
            + $carBookings->count();

        return view('my-bookings.all', compact(
            'hotelBookings',
            'destinationBookings',
            'flightBookings',
            'packageBookings',
            'carBookings',
            'totalBookings'
        ));
    }
}
