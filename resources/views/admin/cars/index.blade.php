@extends('layouts.admin.app')

@section('title', 'Manage Cars')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-cars.css') }}">
@endpush

@section('content')
<div class="admin-cars-page">

    <div class="page-header">
        <div>
            <h2>Manage Cars</h2>
            <p>View and manage all rental cars.</p>
        </div>

        <a href="{{ route('admin.cars.create') }}" class="btn-add-car">
            <i class="fas fa-plus"></i> Add New Car
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="cars-table-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Car</th>
                        <th>Category</th>
                        <th>Transmission</th>
                        <th>Fuel</th>
                        <th>Price / Day</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($cars as $car)
                        <tr>
                            <td>{{ $cars->firstItem() + $loop->index }}</td>

                            <td>
                                <div class="car-info">
                                    @if($car->image)
                                        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}">
                                    @else
                                        <div class="car-placeholder">
                                            <i class="fas fa-car"></i>
                                        </div>
                                    @endif

                                    <div>
                                        <strong>{{ $car->name }}</strong>
                                        <small>{{ $car->brand }} {{ $car->model }}</small>
                                    </div>
                                </div>
                            </td>

                            <td>{{ $car->category }}</td>
                            <td>{{ $car->transmission }}</td>
                            <td>{{ $car->fuel_type }}</td>

                            <td>₹{{ number_format($car->price_per_day, 2) }}</td>

                            <td>
                                @if($car->status)
                                    <span class="status-active">Active</span>
                                @else
                                    <span class="status-inactive">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.cars.edit', $car->id) }}"
                                       class="btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.cars.destroy', $car->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this car?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-delete" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-table">
                                <i class="fas fa-car"></i>
                                <h5>No Cars Added Yet</h5>
                                <p>Start by adding your first rental car.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $cars->links() }}
        </div>
    </div>

</div>
@endsection