
@extends('layouts.admin.app')

@section('title', 'Message Details | Travely')

@section('content')
<section class="py-5">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Message Details</h2>
                <p class="text-muted mb-0">Read customer enquiry.</p>
            </div>

            <a href="{{ route('admin.contact-messages.index') }}"
               class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i>
                Back to Messages
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Customer Enquiry</h5>

                @if($message->status === 'read')
                    <span class="badge bg-success">Read</span>
                @else
                    <span class="badge bg-danger">Unread</span>
                @endif
            </div>

            <div class="card-body p-4">

                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="text-muted small">Customer Name</label>
                        <h6 class="fw-semibold">{{ $message->name }}</h6>
                    </div>

                    <div class="col-md-6">
                        <label class="text-muted small">Email Address</label>
                        <h6 class="fw-semibold">
                            <a href="mailto:{{ $message->email }}">
                                {{ $message->email }}
                            </a>
                        </h6>
                    </div>

                    <div class="col-md-6">
                        <label class="text-muted small">Subject</label>
                        <h6 class="fw-semibold">{{ $message->subject }}</h6>
                    </div>

                    <div class="col-md-6">
                        <label class="text-muted small">Received On</label>
                        <h6 class="fw-semibold">
                            {{ $message->created_at->format('d M Y, h:i A') }}
                        </h6>
                    </div>

                    <div class="col-12">
                        <hr>
                        <label class="text-muted small mb-2">Customer Message</label>

                        <div class="bg-light rounded p-4">
                            <p class="mb-0" style="white-space: pre-line;">{{ $message->message }}</p>
                        </div>
                    </div>

                    <div class="col-12">
                        <a href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: '.$message->subject) }}"
                           class="btn btn-primary">
                            <i class="fa-solid fa-reply me-2"></i>
                            Reply via Email
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>
</section>
@endsection
