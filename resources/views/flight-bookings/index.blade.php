
@extends('layouts.app')

@section('title', 'My Flight Bookings | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/my-flight-bookings.css') }}">
@endpush

@section('content')

<section class="my-flight-bookings py-5">
    <div class="container">

        <div class="booking-heading mb-4">
            <h1 class="fw-bold">My Flight Bookings</h1>
            <p class="text-muted">View and manage your flight reservations.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($bookings->count() > 0)

            <div class="table-responsive booking-table-wrapper">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Booking Reference</th>
                            <th>Airline</th>
                            <th>Flight</th>
                            <th>Route</th>
                            <th>Departure</th>
                            <th>Passengers</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $booking->booking_reference }}
                                </td>

                                <td>{{ $booking->flight->airline ?? 'Flight unavailable' }}</td>

                                <td>{{ $booking->flight->flight_number ?? '-' }}</td>

                                <td>
                                    {{ $booking->flight->departure_city ?? '-' }}
                                    <i class="fa-solid fa-arrow-right mx-1"></i>
                                    {{ $booking->flight->arrival_city ?? '-' }}
                                </td>

                                <td>
                                    {{ $booking->flight?->departure_time?->format('d M Y, h:i A') ?? '-' }}
                                </td>

                                <td>{{ $booking->passengers }}</td>

                                <td>₹{{ number_format($booking->total_price, 2) }}</td>

                                <td>
                                    <span class="booking-status status-{{ $booking->status }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('my-flight-bookings.show', $booking->booking_reference) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        View
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

            <div class="empty-bookings text-center py-5">
                <i class="fa-solid fa-plane-slash"></i>
                <h4 class="mt-3">No Flight Bookings Yet</h4>
                <p class="text-muted">You haven't booked any flights yet.</p>

                <a href="{{ route('flights.index') }}" class="btn btn-primary mt-2">
                    Explore Flights
                </a>
            </div>

        @endif

    </div>
</section>

@endsection
