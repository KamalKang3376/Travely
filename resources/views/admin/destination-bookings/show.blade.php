
@extends('layouts.admin.app')

@section('title', 'Destination Booking Details | Admin')

@section('content')

<section class="py-4">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold text-success mb-1">Destination Booking Details</h2>
                <p class="text-muted mb-0">
                    View customer and travel reservation information.
                </p>
            </div>

            <a href="{{ route('admin.destination-bookings.index') }}"
               class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Back to Bookings
            </a>
        </div>

        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0">Booking Information</h5>
                    </div>

                    <div class="card-body">

                        <div class="row g-4">

                            <div class="col-md-6">
                                <small class="text-muted">Booking Reference</small>
                                <h6 class="fw-bold text-success mt-1">
                                    {{ $booking->booking_reference }}
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted">Booking Date</small>
                                <h6 class="fw-semibold mt-1">
                                    {{ $booking->created_at->format('d M, Y') }}
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted">Start Date</small>
                                <h6 class="fw-semibold mt-1">
                                    {{ $booking->start_date->format('d M, Y') }}
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted">End Date</small>
                                <h6 class="fw-semibold mt-1">
                                    {{ $booking->end_date->format('d M, Y') }}
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted">Number of Travellers</small>
                                <h6 class="fw-semibold mt-1">
                                    {{ $booking->travellers }}
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted">Price Per Person</small>
                                <h6 class="fw-semibold mt-1">
                                    ₹{{ number_format($booking->price_per_person, 2) }}
                                </h6>
                            </div>

                            <div class="col-12">
                                <hr>
                                <small class="text-muted">Total Booking Amount</small>
                                <h3 class="fw-bold text-success mt-1">
                                    ₹{{ number_format($booking->total_price, 2) }}
                                </h3>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0">Customer Information</h5>
                    </div>

                    <div class="card-body">

                        <div class="row g-4">

                            <div class="col-md-6">
                                <small class="text-muted">Customer Name</small>
                                <h6 class="fw-semibold mt-1">
                                    {{ $booking->customer_name }}
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted">Email Address</small>
                                <h6 class="fw-semibold mt-1">
                                    {{ $booking->customer_email }}
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted">Phone Number</small>
                                <h6 class="fw-semibold mt-1">
                                    {{ $booking->customer_phone ?: 'Not provided' }}
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted">Registered Account</small>
                                <h6 class="fw-semibold mt-1">
                                    {{ $booking->user?->name ?? 'Guest Account' }}
                                </h6>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0">Destination Information</h5>
                    </div>

                    <div class="card-body">

                        @if($booking->destination->image)
                            <img
                                src="{{ asset('storage/' . $booking->destination->image) }}"
                                alt="{{ $booking->destination->name }}"
                                class="img-fluid rounded mb-3"
                                style="width: 100%; height: 250px; object-fit: cover;"
                            >
                        @endif

                        <h5 class="fw-bold">
                            {{ $booking->destination->name }}
                        </h5>

                        <p class="text-muted mb-0">
                            <i class="fa-solid fa-location-dot me-2"></i>
                            {{ $booking->destination->city ? $booking->destination->city . ', ' : '' }}
                            {{ $booking->destination->country }}
                        </p>

                    </div>
                </div>

            </div>

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0">Update Booking Status</h5>
                    </div>

                    <div class="card-body">

                        <p class="text-muted">
                            Current booking status:
                        </p>

                        <span class="badge fs-6 mb-4
                            @if($booking->status === 'pending') bg-warning text-dark
                            @elseif($booking->status === 'confirmed') bg-success
                            @elseif($booking->status === 'cancelled') bg-danger
                            @else bg-primary
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>

                        <form
                            action="{{ route('admin.destination-bookings.update', $booking->booking_reference) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Select New Status
                                </label>

                                <select name="status" class="form-select" required>
                                    <option value="pending"
                                        {{ $booking->status === 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="confirmed"
                                        {{ $booking->status === 'confirmed' ? 'selected' : '' }}>
                                        Confirmed
                                    </option>

                                    <option value="cancelled"
                                        {{ $booking->status === 'cancelled' ? 'selected' : '' }}>
                                        Cancelled
                                    </option>

                                    <option value="completed"
                                        {{ $booking->status === 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>
                                </select>

                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="fa-solid fa-check me-2"></i>
                                Update Booking Status
                            </button>

                        </form>

                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

@endsection

