
@extends('layouts.app')

@section('title', 'Booking Confirmation | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endpush

@section('content')

<section class="booking-confirmation-section">
    <div class="container">

        <div class="confirmation-card">

            <div class="confirmation-icon">
                <i class="fa-solid fa-check"></i>
            </div>

            <span class="confirmation-label">BOOKING RECEIVED</span>

            <h1>Your Booking is Successful!</h1>

            <p class="confirmation-message">
                Thank you for choosing Travely. Your hotel booking request
                has been received successfully.
            </p>

            <div class="confirmation-reference">
                <span>Booking Reference</span>
                <strong>{{ $booking->booking_reference }}</strong>
            </div>

            <div class="confirmation-details">

                <h4>Booking Information</h4>

                <div class="confirmation-row">
                    <span>Hotel</span>
                    <strong>{{ $booking->hotel->name }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Customer</span>
                    <strong>{{ $booking->customer_name }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Check In</span>
                    <strong>{{ $booking->check_in->format('d M Y') }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Check Out</span>
                    <strong>{{ $booking->check_out->format('d M Y') }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Guests</span>
                    <strong>{{ $booking->guests }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Rooms</span>
                    <strong>{{ $booking->rooms }}</strong>
                </div>

                <div class="confirmation-row">
                    <span>Total Amount</span>
                    <strong>
                        ₹{{ number_format((float) $booking->total_price, 2) }}
                    </strong>
                </div>

                <div class="confirmation-row">
                    <span>Booking Status</span>
                    <span class="booking-status status-{{ $booking->status }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

            </div>

            <div class="confirmation-notice">
                <i class="fa-solid fa-circle-info"></i>
                Your booking is currently pending. Please wait for
                confirmation from the administrator.
            </div>

            <div class="confirmation-actions">

                <a href="{{ route('my-bookings') }}"
                   class="btn confirmation-primary-btn">
                    <i class="fa-solid fa-calendar-check me-2"></i>
                    My Bookings
                </a>

                <a href="{{ route('hotels.index') }}"
                   class="btn confirmation-secondary-btn">
                    Explore More Hotels
                </a>

            </div>

        </div>

    </div>
</section>

@endsection
