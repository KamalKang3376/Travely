
@extends('layouts.app')

@section('title', 'My Package Bookings | Travely')

@section('content')

<link rel="stylesheet" href="{{ asset('css/my-package-bookings.css') }}">

<div class="my-package-bookings-page">

    <div class="container">

        <div class="my-bookings-heading">
            <div>
                <span class="booking-subtitle">YOUR TRAVEL JOURNEY</span>
                <h2>My Package Bookings</h2>
                <p>Manage and track all your travel package reservations.</p>
            </div>

            <a href="{{ route('packages.index') }}" class="browse-packages-btn">
                <i class="fa-solid fa-plus"></i>
                Explore Packages
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($bookings->count() > 0)

            <div class="package-bookings-table-wrapper">

                <div class="table-responsive">

                    <table class="table package-bookings-table align-middle">

                        <thead>
                            <tr>
                                <th>Booking Reference</th>
                                <th>Package</th>
                                <th>Travel Date</th>
                                <th>Travellers</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($bookings as $booking)

                                <tr>
                                    <td>
                                        <strong class="booking-reference">
                                            {{ $booking->booking_reference }}
                                        </strong>
                                    </td>

                                    <td>
                                        <div class="booking-package-info">
                                            <strong>{{ $booking->package_name }}</strong>
                                            <small>
                                                <i class="fa-solid fa-location-dot"></i>
                                                {{ $booking->destination }}
                                            </small>
                                        </div>
                                    </td>

                                    <td>
                                        {{ $booking->travel_date->format('d M, Y') }}
                                    </td>

                                    <td>{{ $booking->travellers }}</td>

                                    <td class="booking-amount">
                                        ₹{{ number_format($booking->total_amount, 2) }}
                                    </td>

                                    <td>
                                        <span class="booking-status {{ $booking->status }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('my-package-bookings.show', $booking->id) }}"
                                           class="view-package-booking-btn">
                                            View Details
                                        </a>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="package-bookings-pagination">
                    {{ $bookings->links() }}
                </div>

            </div>

        @else

            <div class="empty-package-bookings">

                <div class="empty-bookings-icon">
                    <i class="fa-solid fa-suitcase-rolling"></i>
                </div>

                <h3>No Package Bookings Yet</h3>

                <p>
                    You haven't booked any travel packages yet.
                    Explore our packages and plan your next adventure!
                </p>

                <a href="{{ route('packages.index') }}" class="browse-packages-btn">
                    Explore Packages
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        @endif

    </div>

</div>

@endsection
