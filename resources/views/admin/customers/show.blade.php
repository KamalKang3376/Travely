
@extends('layouts.admin.app')

@section('title', 'Customer Details | Travely')

@section('content')
<section class="py-5">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Customer Details</h2>
                <p class="text-muted mb-0">View customer information and booking history.</p>
            </div>

            <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Customers
            </a>
        </div>

        {{-- Customer Information --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Personal Information</h5>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <small class="text-muted">Customer Name</small>
                        <h6 class="fw-semibold">{{ $customer->name }}</h6>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Email Address</small>
                        <h6 class="fw-semibold">{{ $customer->email }}</h6>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Registered On</small>
                        <h6 class="fw-semibold">{{ $customer->created_at->format('d M Y') }}</h6>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Hotel Bookings</small>
                        <h6 class="fw-semibold">{{ $customer->hotelBookings->count() }}</h6>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Destination Bookings</small>
                        <h6 class="fw-semibold">{{ $customer->destinationBookings->count() }}</h6>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted">Account Role</small>
                        <span class="badge bg-success">{{ ucfirst($customer->role) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hotel Booking History --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Hotel Booking History</h5>
            </div>

            <div class="card-body p-0">
                @if($customer->hotelBookings->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Reference</th>
                                    <th>Hotel</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($customer->hotelBookings as $booking)
                                    <tr>
                                        <td>{{ $booking->booking_reference }}</td>
                                        <td>{{ $booking->hotel?->name ?? 'Hotel unavailable' }}</td>
                                        <td>{{ $booking->check_in->format('d M Y') }}</td>
                                        <td>{{ $booking->check_out->format('d M Y') }}</td>
                                        <td>₹{{ number_format($booking->total_price, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : ($booking->status === 'completed' ? 'primary' : 'warning')) }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center py-4 mb-0">
                        No hotel bookings found.
                    </p>
                @endif
            </div>
        </div>

        {{-- Destination Booking History --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Destination Booking History</h5>
            </div>

            <div class="card-body p-0">
                @if($customer->destinationBookings->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Reference</th>
                                    <th>Destination</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Travellers</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($customer->destinationBookings as $booking)
                                    <tr>
                                        <td>{{ $booking->booking_reference }}</td>
                                        <td>{{ $booking->destination?->name ?? 'Destination unavailable' }}</td>
                                        <td>{{ $booking->start_date->format('d M Y') }}</td>
                                        <td>{{ $booking->end_date->format('d M Y') }}</td>
                                        <td>{{ $booking->travellers }}</td>
                                        <td>₹{{ number_format($booking->total_price, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : ($booking->status === 'completed' ? 'primary' : 'warning')) }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center py-4 mb-0">
                        No destination bookings found.
                    </p>
                @endif
            </div>
        </div>

    </div>
</section>
@endsection
