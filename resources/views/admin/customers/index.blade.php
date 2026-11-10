
@extends('layouts.admin.app')

@section('title', 'Customers | Travely')

@section('content')
<section class="py-5">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Customer Management</h2>
                <p class="text-muted mb-0">Manage all registered Travely customers.</p>
            </div>

            <span class="badge bg-primary fs-6">
                Total Customers: {{ $customers->total() }}
            </span>
        </div>

        @if($customers->count())
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Hotel Bookings</th>
                                    <th>Destination Bookings</th>
                                    <th>Registered On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ $customers->firstItem() + $loop->index }}</td>

                                        <td>
                                            <div class="fw-semibold">
                                                {{ $customer->name }}
                                            </div>
                                        </td>

                                        <td>{{ $customer->email }}</td>

                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ $customer->hotel_bookings_count }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge bg-success">
                                                {{ $customer->destination_bookings_count }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $customer->created_at->format('d M Y') }}
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.customers.show', $customer->id) }}"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fa-solid fa-eye me-1"></i>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    {{ $customers->links() }}
                </div>
            </div>
        @else
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fa-solid fa-users fa-3x text-muted mb-3"></i>
                    <h5>No Customers Found</h5>
                    <p class="text-muted mb-0">
                        Registered customers will appear here.
                    </p>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
