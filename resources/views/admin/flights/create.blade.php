
@extends('layouts.admin.app')

@section('title', 'Add Flight | Admin')

@section('content')
<section class="py-5">
    <div class="container-fluid">

        <div class="mb-4">
            <h2 class="fw-bold">Add New Flight</h2>
            <p class="text-muted">Enter flight details below.</p>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <form action="{{ route('admin.flights.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('admin.flights.form')

                    <button type="submit" class="btn btn-success mt-3">
                        <i class="fa-solid fa-save me-2"></i>Save Flight
                    </button>

                    <a href="{{ route('admin.flights.index') }}" class="btn btn-secondary mt-3">
                        Cancel
                    </a>
                </form>

            </div>
        </div>

    </div>
</section>
@endsection
