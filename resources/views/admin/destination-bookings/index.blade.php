
@extends('layouts.admin.app')

@section('title', 'Destination Bookings | Admin')

@section('content')

<section class="py-4">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold text-success mb-1">Destination Bookings</h2>
                <p class="text-muted mb-0">
                    Manage all customer destination reservations.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Dashboard
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fa-solid fa-plane me-2 text-success"></i>
                    All Destination Bookings
                </h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Booking Reference</th>
                                <th>Customer</th>
                                <th>Destination</th>
                                <th>Travel Dates</th>
                                <th>Travellers</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($bookings as $booking)

                                <tr>
                                    <td>{{ $bookings->firstItem() + $loop->index }}</td>

                                    <td>
                                        <span class="fw-bold text-success">
                                            {{ $booking->booking_reference }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="fw-semibold">
                                            {{ $booking->customer_name }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $booking->customer_email }}
                                        </small>
                                    </td>

                                    <td>
                                        <div class="fw-semibold">
                                            {{ $booking->destination->name }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $booking->destination->country }}
                                        </small>
                                    </td>

                                    <td>
                                        {{ $booking->start_date->format('d M Y') }}
                                        <br>
                                        <small class="text-muted">
                                            To {{ $booking->end_date->format('d M Y') }}
                                        </small>
                                    </td>

                                    <td>
                                        {{ $booking->travellers }}
                                    </td>

                                    <td class="fw-bold">
                                        ₹{{ number_format($booking->total_price, 2) }}
                                    </td>

                                    <td>
                                        <span class="badge
                                            @if($booking->status === 'pending') bg-warning text-dark
                                            @elseif($booking->status === 'confirmed') bg-success
                                            @elseif($booking->status === 'cancelled') bg-danger
                                            @else bg-primary
                                            @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.destination-bookings.show', $booking->booking_reference) }}"
                                           class="btn btn-sm btn-outline-success">
                                            <i class="fa-solid fa-eye me-1"></i>
                                            View
                                        </a>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <i class="fa-solid fa-plane fa-3x text-muted mb-3"></i>
                                        <h5>No destination bookings found</h5>
                                        <p class="text-muted mb-0">
                                            Customer bookings will appear here.
                                        </p>
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-4">
                    {{ $bookings->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
