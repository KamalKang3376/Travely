
@extends('layouts.app')

@section('title', 'My Bookings | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/my-bookings.css') }}">
@endpush

@section('content')

<section class="my-bookings-section">
    <div class="container">

        <div class="bookings-heading">
            <span>YOUR TRAVEL JOURNEY</span>
            <h1>My Bookings</h1>
            <p>View and manage your hotel reservations.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($bookings->count())

            <div class="table-responsive bookings-table-wrapper">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Booking Reference</th>
                            <th>Hotel</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Guests</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>
                                    <strong>
                                       <a href="{{ route('my-bookings.show', $booking->booking_reference) }}"
                                        class="text-decoration-none fw-bold"
                                        style="color: #12332e;">
                                            {{ $booking->booking_reference }}
                                        </a>
                                                                            </strong>
                                </td>

                                <td>
                                    <div class="booking-hotel">
                                        @if($booking->hotel && $booking->hotel->image)
                                            <img
                                                src="{{ travely_image_url($booking->hotel->image) }}"
                                                alt="{{ $booking->hotel->name }}"
                                            >
                                        @endif

                                        <span>
                                            {{ $booking->hotel->name ?? 'Hotel unavailable' }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    {{ $booking->check_in->format('d M Y') }}
                                </td>

                                <td>
                                    {{ $booking->check_out->format('d M Y') }}
                                </td>

                                <td>
                                    {{ $booking->guests }}
                                </td>

                                <td>
                                    <strong>
                                        ₹{{ number_format((float) $booking->total_price, 2) }}
                                    </strong>
                                </td>

                                <td>
                                    <span class="booking-status status-{{ $booking->status }}">
                                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bookings-pagination">
                {{ $bookings->links() }}
            </div>

        @else

            <div class="empty-bookings">
                <i class="fa-solid fa-suitcase-rolling"></i>
                <h3>No Bookings Yet</h3>
                <p>You haven't made any hotel reservations yet.</p>

                <a href="{{ route('hotels.index') }}" class="btn booking-browse-btn">
                    Explore Hotels
                </a>
            </div>

        @endif

    </div>
</section>

@endsection
