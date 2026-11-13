
@extends('layouts.app')

@section('title', 'My All Bookings | Travely')

@push('styles')
<style>
    .all-bookings-page {
        background: #f5f9f8;
        min-height: 650px;
        padding: 55px 0;
    }

    .bookings-header {
        background: #12332e;
        color: #fff;
        padding: 30px;
        border-radius: 14px;
        margin-bottom: 30px;
    }

    .booking-section {
        background: #fff;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 3px 15px rgba(0,0,0,.05);
        margin-bottom: 25px;
    }

    .booking-section h4 {
        color: #12332e;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .booking-item {
        border: 1px solid #e8eeeb;
        border-radius: 10px;
        padding: 18px;
        margin-bottom: 15px;
    }

    .booking-item:last-child {
        margin-bottom: 0;
    }

    .booking-reference {
        color: #12332e;
        font-weight: 700;
    }

    .booking-label {
        color: #777;
        font-size: 13px;
        display: block;
        margin-bottom: 5px;
    }

    .booking-value {
        font-weight: 600;
        color: #333;
        overflow-wrap: anywhere;
    }

    .booking-status {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        background: #e8f5e9;
        color: #26743b;
        font-size: 12px;
        font-weight: 600;
    }

    .booking-empty {
        color: #888;
        padding: 15px 0;
    }

    .booking-total {
        color: #12332e;
        font-weight: 700;
    }

    @media(max-width: 576px) {
        .all-bookings-page {
            padding: 30px 0;
        }

        .booking-section {
            padding: 17px;
        }

        .bookings-header {
            padding: 22px;
        }
    }
</style>
@endpush

@section('content')

<div class="all-bookings-page">
    <div class="container">

        <div class="bookings-header">
            <h2 class="fw-bold">My All Bookings</h2>
            <p class="mb-2">Manage and view all your travel bookings in one place.</p>
            <h5 class="mb-0">
                Total Bookings: {{ $totalBookings }}
            </h5>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @php
            $sections = [
                ['title' => 'Hotel Bookings', 'icon' => 'fa-hotel', 'items' => $hotelBookings, 'type' => 'hotel'],
                ['title' => 'Destination Bookings', 'icon' => 'fa-map-location-dot', 'items' => $destinationBookings, 'type' => 'destination'],
                ['title' => 'Flight Bookings', 'icon' => 'fa-plane', 'items' => $flightBookings, 'type' => 'flight'],
                ['title' => 'Package Bookings', 'icon' => 'fa-suitcase-rolling', 'items' => $packageBookings, 'type' => 'package'],
                ['title' => 'Car Rental Bookings', 'icon' => 'fa-car', 'items' => $carBookings, 'type' => 'car'],
            ];
        @endphp

        @foreach($sections as $section)

            <div class="booking-section">

                <h4>
                    <i class="fa-solid {{ $section['icon'] }} me-2"></i>
                    {{ $section['title'] }}
                    <span class="badge bg-secondary ms-2">
                        {{ $section['items']->count() }}
                    </span>
                </h4>

                @forelse($section['items'] as $booking)

                    <div class="booking-item">

                        <div class="row gy-3 align-items-center">

                            <div class="col-md-4">
                                <span class="booking-label">Booking Reference</span>
                                <span class="booking-reference">
                                    {{ $booking->booking_reference }}
                                </span>
                            </div>

                            <div class="col-md-4">
                                <span class="booking-label">Customer</span>
                                <span class="booking-value">
                                    {{ $booking->customer_name }}
                                </span>
                            </div>

                            <div class="col-md-4">
                                <span class="booking-label">Status</span>
                                <span class="booking-status">
                                    {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                </span>
                            </div>

                            <div class="col-md-4">
                                <span class="booking-label">Email</span>
                                <span class="booking-value">
                                    {{ $booking->customer_email }}
                                </span>
                            </div>

                            @if($section['type'] === 'hotel')
                                <div class="col-md-4">
                                    <span class="booking-label">Check In</span>
                                    <span class="booking-value">{{ $booking->check_in?->format('d M, Y') }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Check Out</span>
                                    <span class="booking-value">{{ $booking->check_out?->format('d M, Y') }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Guests / Rooms</span>
                                    <span class="booking-value">{{ $booking->guests }} / {{ $booking->rooms }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Total Amount</span>
                                    <span class="booking-total">₹{{ number_format($booking->total_price, 2) }}</span>
                                </div>

                            @elseif($section['type'] === 'destination')
                                <div class="col-md-4">
                                    <span class="booking-label">Start Date</span>
                                    <span class="booking-value">{{ $booking->start_date?->format('d M, Y') }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">End Date</span>
                                    <span class="booking-value">{{ $booking->end_date?->format('d M, Y') }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Travellers</span>
                                    <span class="booking-value">{{ $booking->travellers }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Total Amount</span>
                                    <span class="booking-total">₹{{ number_format($booking->total_price, 2) }}</span>
                                </div>

                            @elseif($section['type'] === 'flight')
                                <div class="col-md-4">
                                    <span class="booking-label">Passengers</span>
                                    <span class="booking-value">{{ $booking->passengers }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Total Amount</span>
                                    <span class="booking-total">₹{{ number_format($booking->total_price, 2) }}</span>
                                </div>

                            @elseif($section['type'] === 'package')
                                <div class="col-md-4">
                                    <span class="booking-label">Package</span>
                                    <span class="booking-value">{{ $booking->package_name }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Travel Date</span>
                                    <span class="booking-value">{{ $booking->travel_date?->format('d M, Y') }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Travellers</span>
                                    <span class="booking-value">{{ $booking->travellers }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Total Amount</span>
                                    <span class="booking-total">₹{{ number_format($booking->total_amount, 2) }}</span>
                                </div>

                            @elseif($section['type'] === 'car')
                                <div class="col-md-4">
                                    <span class="booking-label">Pickup Date</span>
                                    <span class="booking-value">{{ $booking->pickup_datetime?->format('d M, Y h:i A') }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Return Date</span>
                                    <span class="booking-value">{{ $booking->return_datetime?->format('d M, Y h:i A') }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Pickup Location</span>
                                    <span class="booking-value">{{ $booking->pickup_location }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="booking-label">Total Amount</span>
                                    <span class="booking-total">₹{{ number_format($booking->total_price, 2) }}</span>
                                </div>
                            @endif

                        </div>

                    </div>

                @empty
                    <p class="booking-empty mb-0">
                        No {{ strtolower($section['title']) }} found.
                    </p>
                @endforelse

            </div>

        @endforeach

        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Back to Dashboard
        </a>

    </div>
</div>

@endsection
