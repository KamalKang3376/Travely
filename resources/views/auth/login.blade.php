@extends('layouts.app')

@section('title', 'Login | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')

<section class="auth-section">

    <div class="container">

        <div class="auth-card">

            <div class="auth-header">
                <i class="fa-solid fa-plane-departure"></i>
                <h2>Welcome Back</h2>
                <p>Login to continue your travel journey.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

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
                        placeholder="Enter your password" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember"
                        class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Login
                </button>

            </form>

            <div class="auth-bottom">
                Don't have an account?
                <a href="{{ route('register') }}">Register Now</a>
            </div>

        </div>

    </div>

</section>

@endsection