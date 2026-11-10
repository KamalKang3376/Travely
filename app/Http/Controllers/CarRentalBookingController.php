<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarRentalBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class CarRentalBookingController extends Controller
{
    public function create($slug)
    {
        $car = Car::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('cars.book', compact('car'));
    }

    public function store(Request $request, $slug)
    {
        $car = Car::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'pickup_datetime' => 'required|date|after_or_equal:now',
            'return_datetime' => 'required|date|after:pickup_datetime',
            'pickup_location' => 'required|string|max:255',
            'dropoff_location' => 'required|string|max:255',
        ]);

        $pickup = Carbon::parse($validated['pickup_datetime']);
        $return = Carbon::parse($validated['return_datetime']);

        $rentalDays = max(1, (int) ceil(
            $pickup->diffInSeconds($return) / 86400
        ));

        $totalPrice = $rentalDays * $car->price_per_day;

        $booking = DB::transaction(function () use (
            $car,
            $validated,
            $pickup,
            $return,
            $rentalDays,
            $totalPrice
        ) {
            $lockedCar = Car::whereKey($car->id)
                ->lockForUpdate()
                ->firstOrFail();

            $overlappingBooking = CarRentalBooking::where('car_id', $lockedCar->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->where('pickup_datetime', '<', $return)
                ->where('return_datetime', '>', $pickup)
                ->exists();

            if ($overlappingBooking) {
                throw ValidationException::withMessages([
                    'pickup_datetime' => 'This car is already booked during the selected dates. Please choose another date.',
                ]);
            }

            return CarRentalBooking::create([
                'booking_reference' => 'CAR-' . strtoupper(Str::random(8)),
                'user_id' => auth()->id(),
                'car_id' => $lockedCar->id,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'pickup_datetime' => $pickup,
                'return_datetime' => $return,
                'pickup_location' => $validated['pickup_location'],
                'dropoff_location' => $validated['dropoff_location'],
                'rental_days' => $rentalDays,
                'price_per_day' => $lockedCar->price_per_day,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);
        });

        return redirect()->route(
            'cars.booking.confirmation',
            $booking->booking_reference
        );
    }
    public function confirmation($reference)
{
    $booking = CarRentalBooking::with('car')
        ->where('booking_reference', $reference)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    return view('cars.confirmation', compact('booking'));
}

public function myBookings()
{
    $bookings = CarRentalBooking::with('car')
        ->where('user_id', auth()->id())
        ->latest()
        ->paginate(10);

    return view('car-bookings.index', compact('bookings'));
}

public function showMyBooking($reference)
{
    $booking = CarRentalBooking::with('car')
        ->where('booking_reference', $reference)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    return view('car-bookings.show', compact('booking'));
}

public function cancelMyBooking($reference)
{
    $booking = CarRentalBooking::where('booking_reference', $reference)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    if (!in_array($booking->status, ['pending', 'confirmed'])) {
        return back()->with('error', 'This booking cannot be cancelled.');
    }

    $booking->update([
        'status' => 'cancelled',
    ]);

    return redirect()
        ->route('my-car-bookings')
        ->with('success', 'Your car rental booking has been cancelled.');
}
}