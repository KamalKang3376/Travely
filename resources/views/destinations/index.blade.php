
@extends('layouts.app')

@section('title', 'Explore Destinations | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/destinations.css') }}">
@endpush

@section('content')

<section class="destination-banner">
    <div class="container text-center">
        <h1>Explore Beautiful Destinations</h1>
        <p>Discover amazing places and plan your next adventure.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">

        <div class="row gy-4">

            @forelse($destinations as $destination)

                <div class="col-lg-4 col-md-6">

                    <div class="destination-list-card">

                        @if($destination->image)
                            <img src="{{ travely_image_url($destination->image) }}"
                                alt="{{ $destination->name }}">
                        @else
                            <img src="https://placehold.co/600x400?text=Destination"
                                alt="Destination image">
                        @endif

                        <div class="p-3">

                            <h4>{{ $destination->name }}</h4>

                            <p class="text-muted">
                                <i class="fa-solid fa-location-dot"></i>
                                {{ $destination->city ? $destination->city . ', ' : '' }}
                                {{ $destination->country }}
                            </p>

                            <p>
                                {{ Str::limit($destination->description, 100) }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                                <div>
                                    <small class="text-muted">Starting from</small>
                                    <h5 class="mb-0 text-success">
                                        ₹{{ number_format($destination->starting_price, 2) }}
                                    </h5>
                                </div>

                                <div class="d-flex gap-2">

                                    <a href="{{ route('destinations.show', $destination->slug) }}"
                                        class="btn btn-primary">
                                        Explore
                                    </a>

                                    <a href="{{ route('destination-bookings.create', $destination->slug) }}"
                                        class="btn btn-success">
                                        <i class="fa-solid fa-calendar-check me-1"></i>
                                        Book Now
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center py-5">
                    <h4>No destinations available yet.</h4>
                    <p class="text-muted">Please check back soon.</p>
                </div>

            @endforelse

        </div>

        <div class="mt-5">
            {{ $destinations->links('pagination::bootstrap-5') }}
        </div>

    </div>
</section>

@endsection
