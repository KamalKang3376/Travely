 @extends('layouts.app')

@section('title', 'Car Booking Confirmation - Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/car-booking.css') }}">
@endpush

@section('content')

<section class="car-confirmation-section">
    <div class="container">

        <div class="confirmation-card">

            <div class="confirmation-icon">
                <i class="fas fa-check"></i>
            </div>

            <span class="confirmation-label">BOOKING REQUEST SUBMITTED</span>

            <h1>Your Car Booking is Received!</h1>

            <p class="confirmation-message">
                Thank you for choosing Travely. Your rental booking request
                has been successfully submitted.
            </p>

            <div class="confirmation-reference">
                <span>Booking Reference</span>
                <strong>{{ $booking->booking_reference }}</strong>
            </div>

            <div class="confirmation-status">
                <span>Booking Status</span>
                <strong class="status-pending">
                    {{ ucfirst($booking->status) }}
                </strong>
            </div>

            <hr>

            <div class="confirmation-car">
                @if($booking->car->image)
                    <img src="{{ asset('storage/' . $booking->car->image) }}"
                         alt="{{ $booking->car->name }}">
                @endif

                <div>
                    <h4>{{ $booking->car->name }}</h4>
                    <p>{{ $booking->car->brand }} {{ $booking->car->model }}</p>
                </div>
            </div>

            <div class="confirmation-details">

                <div>
                    <span>Customer</span>
                    <strong>{{ $booking->customer_name }}</strong>
                </div>

                <div>
                    <span>Pickup Date</span>
                    <strong>{{ $booking->pickup_datetime->format('d M Y, h:i A') }}</strong>
                </div>

                <div>
                    <span>Return Date</span>
                    <strong>{{ $booking->return_datetime->format('d M Y, h:i A') }}</strong>
                </div>

                <div>
                    <span>Rental Duration</span>
                    <strong>{{ $booking->rental_days }} Days</strong>
                </div>

                <div>
                    <span>Pickup Location</span>
                    <strong>{{ $booking->pickup_location }}</strong>
                </div>

                <div>
                    <span>Drop-off Location</span>
                    <strong>{{ $booking->dropoff_location }}</strong>
                </div>

                <div>
                    <span>Price Per Day</span>
                    <strong>₹{{ number_format($booking->price_per_day, 2) }}</strong>
                </div>

                <div class="confirmation-total">
                    <span>Total Amount</span>
                    <strong>₹{{ number_format($booking->total_price, 2) }}</strong>
                </div>

            </div>

            <div class="confirmation-actions">
                <a href="{{ route('cars.index') }}" class="confirmation-primary-btn">
                    Explore More Cars
                </a>

                <a href="{{ route('my-car-bookings') }}" class="confirmation-secondary-btn">
                    My Car Bookings
                </a>
            </div>

        </div>

    </div>
</section>

@endsection