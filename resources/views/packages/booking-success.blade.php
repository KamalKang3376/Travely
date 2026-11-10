@extends('layouts.app')

@section('title', 'Booking Successful | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/package-booking.css') }}">
@endpush

@section('content')

<section class="booking-success-page">

    <div class="container">

        <div class="booking-success-card">

            <div class="success-icon">
                <i class="fa-solid fa-check"></i>
            </div>

            <span class="success-label">BOOKING REQUEST SUBMITTED</span>

            <h1>Thank You for Booking!</h1>

            <p class="success-description">
                Your travel booking request has been received successfully.
                Our team will contact you soon to confirm your trip.
            </p>

            <div class="success-reference">
                <span>Booking Reference</span>
                <strong>{{ $booking->booking_reference }}</strong>
            </div>

            <div class="success-details">

                <div>
                    <span>Package</span>
                    <strong>{{ $booking->package_name }}</strong>
                </div>

                <div>
                    <span>Destination</span>
                    <strong>{{ $booking->destination }}</strong>
                </div>

                <div>
                    <span>Travel Date</span>
                    <strong>{{ $booking->travel_date->format('d M, Y') }}</strong>
                </div>

                <div>
                    <span>Travellers</span>
                    <strong>{{ $booking->travellers }}</strong>
                </div>

                <div>
                    <span>Total Amount</span>
                    <strong>₹{{ number_format($booking->total_amount, 2) }}</strong>
                </div>

                <div>
                    <span>Booking Status</span>
                    <strong class="pending-status">
                        {{ ucfirst($booking->status) }}
                    </strong>
                </div>

            </div>

            <div class="success-actions">
                <a href="{{ route('packages.index') }}" class="success-primary-btn">
                    Explore More Packages
                </a>

                <a href="{{ route('home') }}" class="success-secondary-btn">
                    Back to Home
                </a>
            </div>

        </div>

    </div>

</section>

@endsection