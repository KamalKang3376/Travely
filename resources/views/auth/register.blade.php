@extends('layouts.app')

@section('title', 'Create Account | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')

<section class="auth-section">

    <div class="container">

        <div class="auth-card">

            <div class="auth-header">
                <i class="fa-solid fa-plane-departure"></i>
                <h2>Create Account</h2>
                <p>Join Travely and start exploring the world.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text" name="name"
                        class="form-control"
                        placeholder="Enter your full name"
                        value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label>Email Address</label>
                    <input type="email" name="email"
                        class="form-control"
                        placeholder="Enter your email"
                        value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password"
                        class="form-control"
                        placeholder="Create password" required>
                </div>

                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="form-control"
                        placeholder="Confirm password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Create Account
                </button>

            </form>

            <div class="auth-bottom">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </div>

        </div>

    </div>

</section>

@endsection