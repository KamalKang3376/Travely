
@extends('layouts.app')

@section('title', 'Booking Confirmation | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/destination-booking.css') }}">
@endpush

@section('content')

<section class="booking-confirmation-section">
    <div class="container">

        <div class="confirmation-card">

            <div class="confirmation-icon">
                <i class="fa-solid fa-check"></i>
            </div>

            <span class="confirmation-label">BOOKING SUBMITTED</span>

            <h1>Thank You for Booking!</h1>

            <p class="confirmation-message">
                Your destination booking has been submitted successfully.
                Keep your booking reference for future use.
            </p>

            <div class="booking-reference-box">
                <span>Booking Reference</span>
                <h3>{{ $booking->booking_reference }}</h3>
            </div>

            <div class="confirmation-details">

                <h4>Booking Information</h4>

                <div class="confirmation-detail-row">
                    <span>Destination</span>
                    <strong>{{ $booking->destination->name }}</strong>
                </div>

                <div class="confirmation-detail-row">
                    <span>Customer Name</span>
                    <strong>{{ $booking->customer_name }}</strong>
                </div>

                <div class="confirmation-detail-row">
                    <span>Email Address</span>
                    <strong>{{ $booking->customer_email }}</strong>
                </div>

                <div class="confirmation-detail-row">
                    <span>Phone Number</span>
                    <strong>{{ $booking->customer_phone ?: 'Not provided' }}</strong>
                </div>

                <div class="confirmation-detail-row">
                    <span>Travel Start Date</span>
                    <strong>{{ $booking->start_date->format('d M Y') }}</strong>
                </div>

                <div class="confirmation-detail-row">
                    <span>Travel End Date</span>
                    <strong>{{ $booking->end_date->format('d M Y') }}</strong>
                </div>

                <div class="confirmation-detail-row">
                    <span>Travellers</span>
                    <strong>{{ $booking->travellers }}</strong>
                </div>

                <div class="confirmation-detail-row">
                    <span>Price Per Person</span>
                    <strong>₹{{ number_format((float) $booking->price_per_person, 2) }}</strong>
                </div>

                <div class="confirmation-detail-row">
                    <span>Booking Status</span>
                    <strong class="text-warning">
                        {{ ucfirst($booking->status) }}
                    </strong>
                </div>

                <div class="confirmation-total">
                    <span>Total Amount</span>
                    <h3>₹{{ number_format((float) $booking->total_price, 2) }}</h3>
                </div>

            </div>

            <div class="confirmation-actions">
                <a href="{{ route('destinations.index') }}" class="btn btn-success">
                    Explore More Destinations
                </a>

                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                    My Dashboard
                </a>
            </div>

        </div>

    </div>
</section>

@endsection
