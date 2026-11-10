<?php

namespace App\Http\Controllers;

use App\Models\PackageBooking;
use App\Mail\PackageBookingStatusUpdate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MyPackageBookingController extends Controller
{
    public function index(): View
    {
        $bookings = PackageBooking::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('my-bookings.packages.index', compact('bookings'));
    }

    public function show($id): View
    {
        $booking = PackageBooking::where('user_id', auth()->id())
            ->findOrFail($id);

        return view('my-bookings.packages.show', compact('booking'));
    }

    public function cancel($id): RedirectResponse
    {
        $booking = PackageBooking::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $booking->update([
            'status' => 'cancelled',
        ]);

        Mail::to($booking->customer_email)
            ->send(new PackageBookingStatusUpdate($booking));

        return redirect()
            ->route('my-package-bookings.show', $booking->id)
            ->with('success', 'Your package booking has been cancelled successfully.');
    }
}