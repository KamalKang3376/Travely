@extends('layouts.admin.app')

@section('title', 'Booking Details')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin-package-bookings.css') }}">

<div class="admin-package-bookings">

    <div class="booking-details-header">
        <div>
            <h2>Booking Details</h2>
            <p>View and manage package booking information.</p>
        </div>

        <a href="{{ route('admin.package-bookings.index') }}"
           class="booking-back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Bookings
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="booking-details-card">

        <div class="booking-details-top">
            <div>
                <span class="booking-detail-label">Booking Reference</span>
                <h3>{{ $booking->booking_reference }}</h3>
            </div>

            <span class="booking-status {{ $booking->status }}">
                {{ ucfirst($booking->status) }}
            </span>
        </div>

        <div class="booking-details-grid">

            <div class="booking-detail-item">
                <span>Customer Name</span>
                <strong>{{ $booking->customer_name }}</strong>
            </div>

            <div class="booking-detail-item">
                <span>Email Address</span>
                <strong>{{ $booking->customer_email }}</strong>
            </div>

            <div class="booking-detail-item">
                <span>Phone Number</span>
                <strong>{{ $booking->customer_phone }}</strong>
            </div>

            <div class="booking-detail-item">
                <span>Package Name</span>
                <strong>{{ $booking->package_name }}</strong>
            </div>

            <div class="booking-detail-item">
                <span>Destination</span>
                <strong>{{ $booking->destination }}</strong>
            </div>

            <div class="booking-detail-item">
                <span>Travel Date</span>
                <strong>{{ $booking->travel_date->format('d M, Y') }}</strong>
            </div>

            <div class="booking-detail-item">
                <span>Number of Travellers</span>
                <strong>{{ $booking->travellers }}</strong>
            </div>

            <div class="booking-detail-item">
                <span>Price Per Person</span>
                <strong>₹{{ number_format($booking->price_per_person, 2) }}</strong>
            </div>

            <div class="booking-detail-item">
                <span>Total Amount</span>
                <strong class="booking-total-amount">
                    ₹{{ number_format($booking->total_amount, 2) }}
                </strong>
            </div>

            <div class="booking-detail-item full-width">
                <span>Special Request</span>
                <strong>
                    {{ $booking->special_request ?: 'No special request' }}
                </strong>
            </div>

        </div>

        <div class="booking-management-section">

            <div class="booking-management-box">
                <h4>Update Booking Status</h4>

                <form action="{{ route('admin.package-bookings.update-status', $booking->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <select name="status" class="form-select mb-3">
                        <option value="pending"
                            {{ $booking->status == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="confirmed"
                            {{ $booking->status == 'confirmed' ? 'selected' : '' }}>
                            Confirmed
                        </option>

                        <option value="cancelled"
                            {{ $booking->status == 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>
                    </select>

                    <button type="submit" class="booking-update-btn">
                        <i class="fa-solid fa-check"></i>
                        Update Status
                    </button>

                </form>
            </div>

            <div class="booking-management-box booking-delete-box">
                <h4>Delete Booking</h4>

                <p>Delete this booking permanently from the system.</p>

                <form action="{{ route('admin.package-bookings.destroy', $booking->id) }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this booking?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="booking-delete-btn">
                        <i class="fa-solid fa-trash"></i>
                        Delete Booking
                    </button>

                </form>
            </div>

        </div>

    </div>

</div>

@endsection