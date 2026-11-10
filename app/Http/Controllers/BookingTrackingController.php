<?php

namespace App\Http\Controllers;

use App\Models\PackageBooking;
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

        $booking = PackageBooking::where(
            'booking_reference',
            $validated['booking_reference']
        )
        ->where('customer_email', $validated['customer_email'])
        ->first();

        if (!$booking) {
            return back()
                ->withInput()
                ->withErrors([
                    'booking_reference' => 'No booking found with these details. Please check your reference and email.',
                ]);
        }

        return view('packages.track-booking-result', compact('booking'));
    }
}