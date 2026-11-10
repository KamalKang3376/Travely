
@extends('layouts.admin.app')

@section('title', 'Booking Details | Admin')

@section('content')

<section class="py-5 bg-light">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold text-success">Booking Details</h2>
                <p class="text-muted mb-0">
                    Reference: {{ $booking->booking_reference }}
                </p>
            </div>

            <a href="{{ route('admin.hotel-bookings.index') }}"
               class="btn btn-outline-secondary">
                Back to Bookings
            </a>
        </div>

        <div class="row g-4">

            <!-- Customer, Hotel and Stay Information -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">Customer Information</h4>

                        <p><strong>Name:</strong> {{ $booking->customer_name }}</p>
                        <p><strong>Email:</strong> {{ $booking->customer_email }}</p>
                        <p><strong>Phone:</strong> {{ $booking->customer_phone ?: 'Not provided' }}</p>

                        <hr>

                        <h4 class="fw-bold mb-4">Hotel Information</h4>

                        <p><strong>Hotel:</strong> {{ $booking->hotel->name }}</p>
                        <p><strong>Location:</strong> {{ $booking->hotel->city }}, {{ $booking->hotel->country }}</p>
                        <p><strong>Price per night:</strong> ₹{{ number_format((float) $booking->price_per_night, 2) }}</p>

                        <hr>

                        <h4 class="fw-bold mb-4">Stay Information</h4>

                        <p><strong>Check-in:</strong> {{ $booking->check_in->format('d M Y') }}</p>
                        <p><strong>Check-out:</strong> {{ $booking->check_out->format('d M Y') }}</p>
                        <p><strong>Guests:</strong> {{ $booking->guests }}</p>
                        <p><strong>Rooms:</strong> {{ $booking->rooms }}</p>

                        <hr>

                        <h4 class="fw-bold text-success">
                            Total: ₹{{ number_format((float) $booking->total_price, 2) }}
                        </h4>

                    </div>
                </div>
            </div>

            <!-- Single Booking Status Form -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-3">Update Booking Status</h4>

                        <p>
                            Current Status:
                            <strong>{{ ucfirst($booking->status) }}</strong>
                        </p>

                        <form action="{{ route('admin.hotel-bookings.update', $booking->booking_reference) }}"
                              method="POST">

                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="status" class="form-label">
                                    Select Status
                                </label>

                                <select name="status" id="status" class="form-select" required>

                                    <option value="pending" @selected($booking->status === 'pending')>
                                        Pending
                                    </option>

                                    <option value="confirmed" @selected($booking->status === 'confirmed')>
                                        Confirmed
                                    </option>

                                    <option value="cancelled" @selected($booking->status === 'cancelled')>
                                        Cancelled
                                    </option>

                                    <option value="completed" @selected($booking->status === 'completed')>
                                        Completed
                                    </option>

                                </select>

                                @error('status')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                Update Status
                            </button>

                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
