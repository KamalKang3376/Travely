
@extends('layouts.admin.app')

@section('title', 'Hotel Bookings | Admin')

@section('content')
<section class="py-5 bg-light">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold text-success">Hotel Bookings</h2>
                <p class="text-muted mb-0">Manage customer hotel reservations.</p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Reference</th>
                                <th>Customer</th>
                                <th>Hotel</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td class="fw-semibold">
                                        {{ $booking->booking_reference }}
                                    </td>

                                    <td>
                                        {{ $booking->customer_name }}
                                        <small class="d-block text-muted">
                                            {{ $booking->customer_email }}
                                        </small>
                                    </td>

                                    <td>{{ $booking->hotel->name }}</td>

                                    <td>{{ $booking->check_in->format('d M Y') }}</td>

                                    <td>{{ $booking->check_out->format('d M Y') }}</td>

                                    <td class="fw-semibold">
                                        ₹{{ number_format((float) $booking->total_price, 2) }}
                                    </td>

                                    <td>
                                        @php
                                            $statusClass = match($booking->status) {
                                                'confirmed' => 'success',
                                                'cancelled' => 'danger',
                                                'completed' => 'primary',
                                                default => 'warning',
                                            };
                                        @endphp

                                        <span class="badge text-bg-{{ $statusClass }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.hotel-bookings.show', $booking->booking_reference) }}"
                                           class="btn btn-sm btn-outline-success">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        No hotel bookings found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
