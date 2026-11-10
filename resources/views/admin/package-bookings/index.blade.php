@extends('layouts.admin.app')

@section('title', 'Package Bookings')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-package-bookings.css') }}">
@endpush

@section('content')

<div class="admin-package-bookings">

    <div class="admin-page-header">
        <div>
            <h2>Package Bookings</h2>
            <p>Manage customer travel package reservations.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="package-booking-table-card">

        <div class="table-responsive">

            <table class="table package-booking-table">

                <thead>
                    <tr>
                        <th>Booking Reference</th>
                        <th>Customer</th>
                        <th>Package</th>
                        <th>Travel Date</th>
                        <th>Travellers</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                        <tr>

                            <td>
                                <strong>{{ $booking->booking_reference }}</strong>
                            </td>

                            <td>
                                <div class="package-customer-info">
                                    <strong>{{ $booking->customer_name }}</strong>
                                    <small>{{ $booking->customer_email }}</small>
                                </div>
                            </td>

                            <td>
                                <strong>{{ $booking->package_name }}</strong>
                                <small class="d-block text-muted">
                                    {{ $booking->destination }}
                                </small>
                            </td>

                            <td>
                                {{ $booking->travel_date->format('d M, Y') }}
                            </td>

                            <td>{{ $booking->travellers }}</td>

                            <td>
                                <strong>
                                    ₹{{ number_format($booking->total_amount, 2) }}
                                </strong>
                            </td>

                            <td>
                                <span class="booking-status {{ $booking->status }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('admin.package-bookings.show', $booking->id) }}"
                                   class="booking-view-btn">
                                    <i class="fa-solid fa-eye"></i>
                                    View
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fa-solid fa-suitcase-rolling empty-booking-icon"></i>
                                <h5>No Package Bookings Found</h5>
                                <p>Customer bookings will appear here.</p>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="admin-booking-pagination">
            {{ $bookings->links() }}
        </div>

    </div>

</div>

@endsection