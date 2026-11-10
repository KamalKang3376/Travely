
@extends('layouts.admin.app')

@section('title', 'Manage Flights | Admin')

@section('content')
<section class="py-5">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold">Manage Flights</h2>
                <p class="text-muted mb-0">Add and manage available flights.</p>
            </div>

            <a href="{{ route('admin.flights.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus me-2"></i>Add Flight
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Flight</th>
                            <th>Route</th>
                            <th>Departure</th>
                            <th>Price</th>
                            <th>Seats</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($flights as $flight)
                            <tr>
                                <td>{{ $flights->firstItem() + $loop->index }}</td>

                                <td>
                                    <strong>{{ $flight->airline }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $flight->flight_number }}</small>
                                </td>

                                <td>
                                    {{ $flight->departure_city }}
                                    <i class="fa-solid fa-arrow-right mx-1"></i>
                                    {{ $flight->arrival_city }}
                                </td>

                                <td>
                                    {{ $flight->departure_time->format('d M Y, h:i A') }}
                                </td>

                                <td>₹{{ number_format($flight->price, 2) }}</td>

                                <td>
                                    {{ $flight->available_seats }}/{{ $flight->total_seats }}
                                </td>

                                <td>
                                    @if($flight->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.flights.edit', $flight->id) }}"
                                           class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <form action="{{ route('admin.flights.destroy', $flight->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this flight?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    No flights found. Add your first flight.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $flights->links() }}
            </div>
        </div>

    </div>
</section>
@endsection
