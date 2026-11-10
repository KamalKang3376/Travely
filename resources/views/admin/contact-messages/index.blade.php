
@extends('layouts.admin.app')

@section('title', 'Contact Messages | Travely')

@section('content')
<section class="py-5">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Contact Messages</h2>
                <p class="text-muted mb-0">
                    View and manage customer enquiries.
                </p>
            </div>

            <span class="badge bg-primary fs-6">
                Total Messages: {{ $messages->total() }}
            </span>
        </div>

        @if($messages->count())

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <td>{{ $messages->firstItem() + $loop->index }}</td>

                                        <td class="fw-semibold">
                                            {{ $message->name }}
                                        </td>

                                        <td>{{ $message->email }}</td>

                                        <td>{{ $message->subject }}</td>

                                        <td>
                                            {{ $message->created_at->format('d M Y') }}
                                        </td>

                                        <td>
                                            @if($message->status === 'unread')
                                                <span class="badge bg-danger">Unread</span>
                                            @else
                                                <span class="badge bg-success">Read</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.contact-messages.show', $message->id) }}"
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
                    {{ $messages->links() }}
                </div>
            </div>

        @else

            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fa-solid fa-envelope-open-text fa-3x text-muted mb-3"></i>
                    <h5>No Messages Found</h5>
                    <p class="text-muted mb-0">
                        Customer enquiries will appear here.
                    </p>
                </div>
            </div>

        @endif

    </div>
</section>
@endsection
