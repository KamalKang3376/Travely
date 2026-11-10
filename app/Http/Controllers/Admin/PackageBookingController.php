<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageBooking;
use Illuminate\Http\Request;
use App\Mail\PackageBookingStatusUpdate;
use Illuminate\Support\Facades\Mail;

class PackageBookingController extends Controller
{
    public function index()
    {
        $bookings = PackageBooking::latest()->paginate(10);

        return view('admin.package-bookings.index', compact('bookings'));
    }

    public function show(PackageBooking $packageBooking)
    {
        return view('admin.package-bookings.show', [
            'booking' => $packageBooking
        ]);
    }

   public function updateStatus(Request $request, PackageBooking $packageBooking)
{
    $validated = $request->validate([
        'status' => 'required|in:pending,confirmed,cancelled',
    ]);

    $oldStatus = $packageBooking->status;
    $newStatus = $validated['status'];

    $packageBooking->update([
        'status' => $newStatus,
    ]);

    if ($oldStatus !== $newStatus && in_array($newStatus, ['confirmed', 'cancelled'])) {
        Mail::to($packageBooking->customer_email)
            ->send(new PackageBookingStatusUpdate($packageBooking));
    }

    return redirect()
        ->route('admin.package-bookings.show', $packageBooking->id)
        ->with('success', 'Booking status updated successfully.');
}

    public function destroy(PackageBooking $packageBooking)
    {
        $packageBooking->delete();

        return redirect()
            ->route('admin.package-bookings.index')
            ->with('success', 'Package booking deleted successfully.');
    }
}