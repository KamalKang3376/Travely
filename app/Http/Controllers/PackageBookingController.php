<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\PackageBookingConfirmation;
use Illuminate\Support\Facades\Mail;

class PackageBookingController extends Controller
{
    public function create($slug)
    {
        $package = Package::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('packages.booking', compact('package'));
    }

    public function store(Request $request, $slug)
    {
        $package = Package::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'travel_date' => 'required|date|after_or_equal:today',
            'travellers' => 'required|integer|min:1|max:' . $package->max_people,
            'special_request' => 'nullable|string|max:1000',
        ]);

        $price = $package->discount_price ?? $package->price;

        $totalAmount = $price * $validated['travellers'];

        $booking = PackageBooking::create([
            'booking_reference' => 'TRV-' . strtoupper(Str::random(8)),
            'package_id' => $package->id,
            'user_id' => Auth::id(),
            'package_name' => $package->name,
            'destination' => $package->destination,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'travel_date' => $validated['travel_date'],
            'travellers' => $validated['travellers'],
            'price_per_person' => $price,
            'total_amount' => $totalAmount,
            'special_request' => $validated['special_request'] ?? null,
            'status' => 'pending',
        ]);

        Mail::to($booking->customer_email)
         ->send(new PackageBookingConfirmation($booking));

        return redirect()
            ->route('packages.booking.success', $booking->booking_reference)
            ->with('success', 'Your package booking has been submitted successfully!');
    }

    public function success($reference)
    {
        $booking = PackageBooking::where('booking_reference', $reference)
            ->firstOrFail();

        return view('packages.booking-success', compact('booking'));
    }
}