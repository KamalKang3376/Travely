@extends('layouts.admin.app')

@section('title', 'Car Rental Booking Details')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-cars.css') }}">
@endpush

@section('content')
<div class="admin-cars-page">

    <div class="page-header">
        <div>
            <h2>Booking Details</h2>
            <p>Reference: {{ $booking->booking_reference }}</p>
        </div>

        <a href="{{ route('admin.car-rental-bookings.index') }}" class="btn-add-car">
            <i class="fas fa-arrow-left"></i> Back to Bookings
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="car-form-card">

        <h5 class="mb-3">Customer Information</h5>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <strong>Customer Name</strong>
                <p>{{ $booking->customer_name }}</p>
            </div>

            <div class="col-md-4">
                <strong>Email</strong>
                <p>{{ $booking->customer_email }}</p>
            </div>

            <div class="col-md-4">
                <strong>Phone</strong>
                <p>{{ $booking->customer_phone }}</p>
            </div>
        </div>

        <hr>

        <h5 class="mb-3">Car Information</h5>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <strong>Car</strong>
                <p>{{ $booking->car->name ?? 'Car unavailable' }}</p>
            </div>

            <div class="col-md-4">
                <strong>Brand</strong>
                <p>{{ $booking->car->brand ?? '-' }}</p>
            </div>

            <div class="col-md-4">
                <strong>Price Per Day</strong>
                <p>₹{{ number_format($booking->price_per_day, 2) }}</p>
            </div>
        </div>

        <hr>

        <h5 class="mb-3">Rental Information</h5>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <strong>Pickup Date & Time</strong>
                <p>{{ $booking->pickup_datetime->format('d M Y, h:i A') }}</p>
            </div>

            <div class="col-md-4">
                <strong>Return Date & Time</strong>
                <p>{{ $booking->return_datetime->format('d M Y, h:i A') }}</p>
            </div>

            <div class="col-md-4">
                <strong>Rental Duration</strong>
                <p>{{ $booking->rental_days }} Days</p>
            </div>

            <div class="col-md-6">
                <strong>Pickup Location</strong>
                <p>{{ $booking->pickup_location }}</p>
            </div>

            <div class="col-md-6">
                <strong>Drop-off Location</strong>
                <p>{{ $booking->dropoff_location }}</p>
            </div>
        </div>

        <hr>

        <div class="booking-total-box mb-4">
            <span>Total Booking Amount</span>
            <h3>₹{{ number_format($booking->total_price, 2) }}</h3>
        </div>

        <div class="mb-4">
            <strong>Current Status:</strong>
            <span class="booking-status status-{{ $booking->status }}">
                {{ ucfirst($booking->status) }}
            </span>
        </div>

        <hr>

        <h5 class="mb-3">Update Booking Status</h5>

        <form action="{{ route('admin.car-rental-bookings.update', $booking->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row align-items-end g-3">

                <div class="col-md-6">
                    <label class="form-label">Booking Status</label>

                    <select name="status" class="form-select" required>
                        @foreach(['pending', 'confirmed', 'cancelled', 'completed'] as $status)
                            <option value="{{ $status }}"
                                @selected(old('status', $booking->status) == $status)>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>

                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn-save-car">
                        <i class="fas fa-save"></i> Update Status
                    </button>
                </div>

            </div>
        </form>

    </div>

</div>
@endsection