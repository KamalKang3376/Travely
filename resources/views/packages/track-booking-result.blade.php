@extends('layouts.app')

@section('title', 'Booking Details | Travely')

@section('content')

<link rel="stylesheet" href="{{ asset('css/package-booking.css') }}">

<div class="track-booking-page">
    <div class="track-booking-result-card">

        <div class="track-result-header">
            <div class="track-booking-icon">
                <i class="fa-solid fa-ticket"></i>
            </div>

            <h2>Your Booking Details</h2>
            <p>Here is the latest information about your travel booking.</p>
        </div>

        <div class="track-result-reference">
            <span>Booking Reference</span>
            <strong>{{ $booking->booking_reference }}</strong>
        </div>

        <div class="track-result-status">
            <span>Booking Status</span>

            <span class="booking-status {{ $booking->status }}">
                {{ ucfirst($booking->status) }}
            </span>
        </div>

        <div class="track-result-details">

            <div>
                <span>Customer Name</span>
                <strong>{{ $booking->customer_name }}</strong>
            </div>

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
                <span>Price Per Person</span>
                <strong>₹{{ number_format($booking->price_per_person, 2) }}</strong>
            </div>

            <div class="track-result-total">
                <span>Total Amount</span>
                <strong>₹{{ number_format($booking->total_amount, 2) }}</strong>
            </div>

        </div>

        <a href="{{ route('packages.track-booking') }}"
           class="track-again-btn">
            Track Another Booking
        </a>

    </div>
</div>

@endsection