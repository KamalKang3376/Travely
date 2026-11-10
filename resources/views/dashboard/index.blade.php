@extends('layouts.app')

@section('title', 'My Dashboard | Travely')

@section('content')

<section class="py-5" style="background: #f5f9f8; min-height: 550px;">

    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-4 rounded shadow-sm mb-4">

            <h2>Welcome, {{ Auth::user()->name }}!</h2>

            <p class="text-muted mb-0">
                Welcome to your Travely customer dashboard.
            </p>

        </div>

        <div class="row gy-4">

            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow-sm">
                    <i class="fa-solid fa-suitcase text-success fs-2"></i>
                    <h5 class="mt-3">My Bookings</h5>
                    <p class="text-muted">View your travel bookings.</p>
                    <a href="#" class="btn btn-outline-primary">View Bookings</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow-sm">
                    <i class="fa-solid fa-user text-success fs-2"></i>
                    <h5 class="mt-3">My Profile</h5>
                    <p class="text-muted">Manage your account information.</p>
                    <p class="mb-0">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow-sm">
                    <i class="fa-solid fa-earth-americas text-success fs-2"></i>
                    <h5 class="mt-3">Explore Places</h5>
                    <p class="text-muted">Discover new destinations.</p>
                    <a href="{{ url('/') }}" class="btn btn-outline-primary">Explore Now</a>
                </div>
            </div>

        </div>

        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button class="btn btn-danger">
                <i class="fa-solid fa-right-from-bracket me-2"></i>
                Logout
            </button>
        </form>

    </div>

</section>

@endsection