
@extends('layouts.app')

@section('title', 'Car Booking Confirmation - Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/car-booking.css') }}">
@endpush

@section('content')

<section class="car-confirmation-section">
    <div class="container">

        <div class="confirmation-wrapper">

            <div class="confirmation-success">
                <div class="confirmation-icon">
                    <i class="fas fa-check"></i>
                </div>

                <span class="confirmation-label">BOOKING REQUEST SUBMITTED</span>

                <h1>Your Car Booking is Received!</h1>

                <p>
                    Thank you for choosing Travely. Your rental booking request
                    has been successfully submitted.
                </p>
            </div>

            <div class="confirmation-reference">
                <div>
                    <span>Booking Reference</span>
                    <strong>{{ $booking->booking_reference }}</strong>
                </div>

                <div class="confirmation-status">
                    <span>Booking Status</span>
                    <strong>
                        <i class="fas fa-clock"></i>
                        {{ ucfirst($booking->status) }}
                    </strong>
                </div>
            </div>

            <div class="confirmation-car">
                <div class="confirmation-car-image">
                    @if($booking->car->image)
                        <img
                            src="{{ travely_image_url($booking->car->image) }}"
                            alt="{{ $booking->car->name }}">
                    @else
                        <i class="fas fa-car-side"></i>
                    @endif
                </div>

                <div class="confirmation-car-info">
                    <span class="car-info-label">YOUR RENTAL VEHICLE</span>
                    <h3>{{ $booking->car->name }}</h3>
                    <p>{{ $booking->car->brand }} {{ $booking->car->model }}</p>
                </div>
            </div>

            <div class="confirmation-details-heading">
                <h3>Booking Details</h3>
                <p>Here is a summary of your rental information.</p>
            </div>

            <div class="confirmation-details">

                <div class="detail-item">
                    <span><i class="fas fa-user"></i> Customer</span>
                    <strong>{{ $booking->customer_name }}</strong>
                </div>

                <div class="detail-item">
                    <span><i class="fas fa-calendar-check"></i> Pickup Date</span>
                    <strong>{{ $booking->pickup_datetime->format('d M Y, h:i A') }}</strong>
                </div>

                <div class="detail-item">
                    <span><i class="fas fa-calendar-alt"></i> Return Date</span>
                    <strong>{{ $booking->return_datetime->format('d M Y, h:i A') }}</strong>
                </div>

                <div class="detail-item">
                    <span><i class="fas fa-hourglass-half"></i> Rental Duration</span>
                    <strong>{{ $booking->rental_days }} Days</strong>
                </div>

                <div class="detail-item">
                    <span><i class="fas fa-map-marker-alt"></i> Pickup Location</span>
                    <strong>{{ $booking->pickup_location }}</strong>
                </div>

                <div class="detail-item">
                    <span><i class="fas fa-location-arrow"></i> Drop-off Location</span>
                    <strong>{{ $booking->dropoff_location }}</strong>
                </div>

                <div class="detail-item">
                    <span><i class="fas fa-tag"></i> Price Per Day</span>
                    <strong>₹{{ number_format($booking->price_per_day, 2) }}</strong>
                </div>

                <div class="detail-item detail-total">
                    <span>Total Amount</span>
                    <strong>₹{{ number_format($booking->total_price, 2) }}</strong>
                </div>

            </div>

            <div class="confirmation-note">
                <i class="fas fa-info-circle"></i>
                Your booking request is submitted. Please wait for booking confirmation.
            </div>

            <div class="confirmation-actions">
                <a href="{{ route('cars.index') }}" class="confirmation-primary-btn">
                    Explore More Cars
                    <i class="fas fa-arrow-right"></i>
                </a>

                <a href="{{ route('my-car-bookings') }}" class="confirmation-secondary-btn">
                    <i class="fas fa-calendar-alt"></i>
                    My Car Bookings
                </a>
            </div>

        </div>
    </div>
</section>

@endsection
