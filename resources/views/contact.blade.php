
@extends('layouts.app')

@section('title', 'Contact Us | Travely')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')

<section class="contact-hero">
    <div class="container text-center">
        <span class="contact-subtitle">GET IN TOUCH</span>
        <h1>Contact <span>Travely</span></h1>
        <p>Have questions about your next journey? We are here to help.</p>
    </div>
</section>

<section class="contact-section py-5">
    <div class="container">
        <div class="row g-5">

            {{-- Contact Information --}}
            <div class="col-lg-5">
                <div class="contact-info">
                    <h3>Let's Talk About Your Trip</h3>
                    <p class="text-muted mb-4">
                        Send us your questions, suggestions or travel enquiries.
                        Our team will get back to you soon.
                    </p>

                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h6>Email Us</h6>
                            <p>support@travely.com</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h6>Call Us</h6>
                            <p>+91 98765 43210</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h6>Our Location</h6>
                            <p>Punjab, India</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h3>Send Us a Message</h3>
                    <p class="text-muted mb-4">
                        Fill in the details below and submit your enquiry.
                    </p>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Enter your name"
                                    value="{{ old('name', auth()->user()?->name ?? '') }}"
                                    required
                                >
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Enter your email"
                                    value="{{ old('email', auth()->user()?->email ?? '') }}"
                                    required
                                >
                            </div>

                            <div class="col-12">
                                <label class="form-label">Subject</label>
                                <input
                                    type="text"
                                    name="subject"
                                    class="form-control"
                                    placeholder="Enter message subject"
                                    value="{{ old('subject') }}"
                                    required
                                >
                            </div>

                            <div class="col-12">
                                <label class="form-label">Your Message</label>
                                <textarea
                                    name="message"
                                    class="form-control"
                                    rows="6"
                                    placeholder="Write your message here..."
                                    required
                                >{{ old('message') }}</textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary contact-submit-btn">
                                    Send Message
                                    <i class="fa-solid fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection
