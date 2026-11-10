
@extends('layouts.app')

@section('title', 'Booking Confirmation | Travely')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endpush

@section('content')
<section class="confirmation-page">
    <div class="container">
        <div class="confirmation-card">
            <div class="confirmation-icon">
                <i class="fa-solid fa-check"></i>
            </div>

            <span class="booking-tag">BOOKING REQUEST RECEIVED</span>
            <h1>Thank You!</h1>
            <p class="confirmation-message">
                Your hotel booking request has been submitted successfully.
            </p>

            <div class="booking-reference">
                <span>Booking Reference</span>
                <strong>{{ $booking->booking_reference }}</strong>
            </div>

            <div class="confirmation-details text-start">
                <h4>Booking Details</h4>

                <div class="detail-row">
                    <span>Hotel</span>
                    <strong>{{ $booking->hotel->name }}</strong>
                </div>

                <div class="detail-row">
                    <span>Guest Name</span>
                    <strong>{{ $booking->customer_name }}</strong>
                </div>

                <div class="detail-row">
                    <span>Email</span>
                    <strong>{{ $booking->customer_email }}</strong>
                </div>

                <div class="detail-row">
                    <span>Check-in</span>
                    <strong>{{ $booking->check_in->format('d M Y') }}</strong>
                </div>

                <div class="detail-row">
                    <span>Check-out</span>
                    <strong>{{ $booking->check_out->format('d M Y') }}</strong>
                </div>

                <div class="detail-row">
                    <span>Guests</span>
                    <strong>{{ $booking->guests }}</strong>
                </div>

                <div class="detail-row">
                    <span>Rooms</span>
                    <strong>{{ $booking->rooms }}</strong>
                </div>

                <div class="detail-row">
                    <span>Booking Status</span>
                    <strong class="status-pending">{{ ucfirst($booking->status) }}</strong>
                </div>

                <div class="detail-row total-row">
                    <span>Total Amount</span>
                    <strong>₹{{ number_format((float) $booking->total_price, 2) }}</strong>
                </div>
            </div>

            <p class="confirmation-note">
                Your booking is currently pending. Payment and final confirmation
                are not yet processed.
            </p>

            <a href="{{ route('hotels.index') }}" class="btn booking-submit">
                Explore More Hotels
            </a>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary ms-2">
                Back to Home
            </a>
        </div>
    </div>
</section>
@endsection
