
@extends('layouts.app')

@section('title', 'My Destination Bookings | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/my-destination-bookings.css') }}">
@endpush

@section('content')

<section class="my-destination-bookings">
    <div class="container">

        <div class="bookings-heading">
            <div>
                <span>YOUR TRAVEL JOURNEY</span>
                <h1>My Destination Bookings</h1>
                <p>Manage and track all your destination reservations.</p>
            </div>

            <a href="{{ route('destinations.index') }}" class="btn btn-success">
                <i class="fa-solid fa-plus me-2"></i>
                Explore Destinations
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($bookings->count() > 0)

            <div class="table-responsive booking-table-wrapper">
                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th>Booking Reference</th>
                            <th>Destination</th>
                            <th>Travel Dates</th>
                            <th>Travellers</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>
                                    <strong>{{ $booking->booking_reference }}</strong>
                                </td>

                                <td>
                                    <strong>{{ $booking->destination->name }}</strong>
                                    <small class="d-block text-muted">
                                        {{ $booking->destination->country }}
                                    </small>
                                </td>

                                <td>
                                    {{ $booking->start_date->format('d M Y') }}
                                    <small class="d-block text-muted">
                                        to {{ $booking->end_date->format('d M Y') }}
                                    </small>
                                </td>

                                <td>{{ $booking->travellers }}</td>

                                <td>
                                    <strong>
                                        ₹{{ number_format((float) $booking->total_price, 2) }}
                                    </strong>
                                </td>

                                <td>
                                    <span class="booking-status status-{{ $booking->status }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('my-destination-bookings.show', $booking->booking_reference) }}"
                                       class="btn btn-sm btn-outline-success">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="mt-4">
                {{ $bookings->links() }}
            </div>

        @else

            <div class="empty-bookings">
                <i class="fa-solid fa-plane-departure"></i>

                <h3>No Destination Bookings Yet</h3>

                <p>
                    You haven't booked any destinations yet.
                    Start planning your next journey today!
                </p>

                <a href="{{ route('destinations.index') }}" class="btn btn-success">
                    Explore Destinations
                </a>
            </div>

        @endif

    </div>
</section>

@endsection
