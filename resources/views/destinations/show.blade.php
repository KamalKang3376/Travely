@extends('layouts.app')

@section('title', $destination->name . ' | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/destinations.css') }}">
@endpush

@section('content')

<section class="destination-detail">

    @if($destination->image)
        <div class="destination-detail-image"
            style="background-image: url('{{ asset('storage/' . $destination->image) }}')">
        </div>
    @endif

    <div class="container py-5">

        <h1>{{ $destination->name }}</h1>

        <p class="text-muted">
            <i class="fa-solid fa-location-dot"></i>
            {{ $destination->city ? $destination->city . ', ' : '' }}
            {{ $destination->country }}
        </p>

        <div class="row mt-4">

            <div class="col-lg-8">

                <h3>About This Destination</h3>

                <p class="destination-description">
                    {{ $destination->description }}
                </p>

            </div>

            <div class="col-lg-4">

                <div class="destination-price-card">

                    <small>Travel packages starting from</small>

                    <h2 class="text-success mt-2">
                        ₹{{ number_format($destination->starting_price, 2) }}
                    </h2>

                    <p class="text-muted">
                        Explore this destination and plan your trip.
                    </p>

                    <a href="{{ route('home') }}" class="btn btn-primary w-100">
                        Back to Home
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection