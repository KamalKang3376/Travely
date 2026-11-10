
@extends('layouts.admin.app')

@section('title', 'Admin Dashboard | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endpush

@section('content')

<section class="admin-dashboard py-5">
    <div class="container">

        {{-- Dashboard Heading --}}
        <div class="mb-5">
            <h1 class="fw-bold">Admin Dashboard</h1>
            <p class="text-muted">Welcome to Travely administration panel.</p>
        </div>

        {{-- General Statistics --}}
        <div class="row g-4 mb-5">

            <div class="col-md-6 col-lg-3">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <h3>{{ $totalDestinations }}</h3>
                        <p>Total Destinations</p>
                        <a href="{{ route('admin.destinations.index') }}">Manage Destinations</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <i class="fa-solid fa-hotel"></i>
                        <h3>{{ $totalHotels }}</h3>
                        <p>Total Hotels</p>
                        <a href="{{ route('admin.hotels.index') }}">Manage Hotels</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <i class="fa-solid fa-calendar-check"></i>
                        <h3>{{ $totalBookings }}</h3>
                        <p>Total Hotel Bookings</p>
                        <a href="{{ route('admin.hotel-bookings.index') }}">Manage Hotel Bookings</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <i class="fa-solid fa-plane"></i>
                        <h3>{{ $destinationBookings }}</h3>
                        <p>Destination Bookings</p>
                        <small class="text-warning fw-semibold">
                            {{ $pendingDestinationBookings }} Pending
                        </small>
                        <br>
                        <a href="{{ route('admin.destination-bookings.index') }}">Manage Destination Bookings</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <i class="fa-solid fa-users"></i>
                        <h3>{{ $totalUsers }}</h3>
                        <p>Registered Users</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Booking Status Statistics --}}
        <div class="mb-4">
            <h4 class="fw-bold mb-3">Booking Status Statistics</h4>

            <div class="row g-4">

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="text-muted">Pending Hotel Bookings</h6>
                            <h2 class="fw-bold text-warning">{{ $pendingHotelBookings }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="text-muted">Confirmed Hotel Bookings</h6>
                            <h2 class="fw-bold text-success">{{ $confirmedHotelBookings }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="text-muted">Cancelled Hotel Bookings</h6>
                            <h2 class="fw-bold text-danger">{{ $cancelledHotelBookings }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="text-muted">Pending Destination Bookings</h6>
                            <h2 class="fw-bold text-warning">{{ $pendingDestinationBookings }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="text-muted">Confirmed Destination Bookings</h6>
                            <h2 class="fw-bold text-success">{{ $confirmedDestinationBookings }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="text-muted">Cancelled Destination Bookings</h6>
                            <h2 class="fw-bold text-danger">{{ $cancelledDestinationBookings }}</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Revenue Statistics --}}
        <div class="mb-5 mt-5">
            <h4 class="fw-bold mb-3">Revenue Overview</h4>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <i class="fa-solid fa-hotel text-primary fs-3 mb-3"></i>
                            <h6 class="text-muted">Hotel Revenue</h6>
                            <h3 class="fw-bold text-primary">
                                ₹{{ number_format((float) $hotelRevenue, 2) }}
                            </h3>
                            <small class="text-muted">Confirmed hotel bookings</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <i class="fa-solid fa-plane text-success fs-3 mb-3"></i>
                            <h6 class="text-muted">Destination Revenue</h6>
                            <h3 class="fw-bold text-success">
                                ₹{{ number_format((float) $destinationRevenue, 2) }}
                            </h3>
                            <small class="text-muted">Confirmed destination bookings</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <i class="fa-solid fa-indian-rupee-sign text-warning fs-3 mb-3"></i>
                            <h6 class="text-muted">Total Revenue</h6>
                            <h3 class="fw-bold text-dark">
                                ₹{{ number_format((float) $totalRevenue, 2) }}
                            </h3>
                            <small class="text-muted">Combined confirmed bookings</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Monthly Booking Analytics --}}
        <div class="card border-0 shadow-sm mb-5">

            <div class="card-header bg-white py-3">
                <h5 class="mb-1 fw-bold">Monthly Booking Analytics</h5>
                <small class="text-muted">
                    Hotel and destination bookings for {{ now()->year }}
                </small>
            </div>

            <div class="card-body">
                <div style="position: relative; height: 350px; width: 100%;">
                    <canvas id="bookingChart"></canvas>
                </div>
            </div>

        </div>

        {{-- Recent Hotel Bookings --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Recent Hotel Bookings</h5>

                <a href="{{ route('admin.hotel-bookings.index') }}"
                   class="btn btn-sm btn-outline-success">
                    View All
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Customer</th>
                                <th>Hotel</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($recentBookings as $booking)
                                <tr>
                                    <td>{{ $booking->booking_reference }}</td>
                                    <td>{{ $booking->customer_name }}</td>
                                    <td>{{ $booking->hotel?->name ?? 'Hotel unavailable' }}</td>
                                    <td>₹{{ number_format((float) $booking->total_price, 2) }}</td>

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
                                        <a href="{{ route('admin.hotel-bookings.show', $booking->booking_reference) }}"
                                           class="btn btn-sm btn-outline-success">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        No hotel bookings available yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        {{-- Recent Destination Bookings --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Recent Destination Bookings</h5>

                <a href="{{ route('admin.destination-bookings.index') }}"
                   class="btn btn-sm btn-outline-success">
                    View All
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Customer</th>
                                <th>Destination</th>
                                <th>Travellers</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($recentDestinationBookings as $booking)
                                <tr>
                                    <td class="fw-semibold text-success">
                                        {{ $booking->booking_reference }}
                                    </td>

                                    <td>
                                        {{ $booking->customer_name }}
                                        <br>
                                        <small class="text-muted">{{ $booking->customer_email }}</small>
                                    </td>

                                    <td>{{ $booking->destination?->name ?? 'Destination unavailable' }}</td>
                                    <td>{{ $booking->travellers }}</td>
                                    <td>₹{{ number_format((float) $booking->total_price, 2) }}</td>

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
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        No destination bookings available yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

{{-- Booking Chart Script --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const chartElement = document.getElementById('bookingChart');

    if (!chartElement) {
        return;
    }

    new Chart(chartElement, {
        type: 'bar',

        data: {
            labels: @json($bookingChartLabels),

            datasets: [
                {
                    label: 'Hotel Bookings',
                    data: @json($hotelBookingChartData),
                    backgroundColor: '#198754',
                    borderRadius: 5
                },
                {
                    label: 'Destination Bookings',
                    data: @json($destinationBookingChartData),
                    backgroundColor: '#0d6efd',
                    borderRadius: 5
                }
            ]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },

            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

});
</script>
@endpush

