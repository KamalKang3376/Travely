@extends('layouts.app')

@section('title', 'Track Your Booking | Travely')

@section('content')

<link rel="stylesheet" href="{{ asset('css/package-booking.css') }}">

<div class="track-booking-page">
    <div class="track-booking-card">

        <div class="track-booking-icon">
            <i class="fa-solid fa-location-dot"></i>
        </div>

        <h2>Track Your Booking</h2>

        <p>Enter your booking reference and email address to check your travel booking status.</p>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('packages.track-booking.search') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Booking Reference</label>
                <input type="text"
                       name="booking_reference"
                       class="form-control"
                       placeholder="Example: TRV-AB12CD34"
                       value="{{ old('booking_reference') }}"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Email Address</label>
                <input type="email"
                       name="customer_email"
                       class="form-control"
                       placeholder="Enter your booking email"
                       value="{{ old('customer_email') }}"
                       required>
            </div>

            <button type="submit" class="track-booking-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
                Track Booking
            </button>
        </form>

    </div>
</div>

@endsection