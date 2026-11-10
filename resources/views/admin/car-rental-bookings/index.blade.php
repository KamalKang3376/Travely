@extends('layouts.admin.app')

@section('title', 'Car Rental Bookings')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-cars.css') }}">
@endpush

@section('content')
<div class="admin-cars-page">

    <div class="page-header">
        <div>
            <h2>Car Rental Bookings</h2>
            <p>Manage customer car rental reservations.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="cars-table-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Reference</th>
                        <th>Customer</th>
                        <th>Car</th>
                        <th>Pickup</th>
                        <th>Return</th>
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
                                <strong>{{ $booking->booking_reference }}</strong>
                            </td>

                            <td>
                                <strong>{{ $booking->customer_name }}</strong>
                                <small class="d-block text-muted">
                                    {{ $booking->customer_email }}
                                </small>
                            </td>

                            <td>
                                {{ $booking->car->name ?? 'Car unavailable' }}
                            </td>

                            <td>
                                {{ $booking->pickup_datetime->format('d M Y, h:i A') }}
                            </td>

                            <td>
                                {{ $booking->return_datetime->format('d M Y, h:i A') }}
                            </td>

                            <td>
                                ₹{{ number_format($booking->total_price, 2) }}
                            </td>

                            <td>
                                <span class="booking-status status-{{ $booking->status }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('admin.car-rental-bookings.show', $booking->id) }}"
                                   class="btn-edit">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="empty-table">
                                <i class="fas fa-car"></i>
                                <h5>No Car Rental Bookings</h5>
                                <p>Customer reservations will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $bookings->links() }}
        </div>
    </div>

</div>
@endsection