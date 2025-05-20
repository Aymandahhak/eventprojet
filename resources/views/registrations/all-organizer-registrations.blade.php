@extends('layouts.organizer')

@section('dashboard-title', 'All Registrations')

@section('dashboard-content')
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Event Registrations</h5>
            <form action="{{ route('organizer.all-registrations') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by name or email" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </form>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Event</th>
                        <th>User</th>
                        <th>Tickets</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $registration)
                        <tr>
                            <td>{{ $registration->id }}</td>
                            <td>
                                <a href="{{ route('events.show', $registration->event) }}" class="text-decoration-none">
                                    {{ Str::limit($registration->event->title, 30) }}
                                </a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="ms-2">
                                        <h6 class="mb-0 fw-semibold">{{ $registration->user->name }}</h6>
                                        <small class="text-muted">{{ $registration->user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $registration->ticket_quantity }}</td>
                            <td>{{ $registration->total_price }} DH</td>
                            <td>
                                <span class="badge bg-{{ $registration->status == 'confirmed' ? 'success' : ($registration->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $registration->payment_status == 'paid' ? 'success' : ($registration->payment_status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($registration->payment_status) }}
                                </span>
                            </td>
                            <td>{{ $registration->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('organizer.registrations', ['event' => $registration->event->id]) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $registration->id }}">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $registration->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                
                                <!-- Confirm Modal -->
                                <div class="modal fade" id="confirmModal{{ $registration->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('registrations.update-status', $registration) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="confirmed">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Registration</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to confirm this registration?</p>
                                                    <p><strong>Event:</strong> {{ $registration->event->title }}</p>
                                                    <p><strong>User:</strong> {{ $registration->user->name }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Confirm Registration</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Cancel Modal -->
                                <div class="modal fade" id="cancelModal{{ $registration->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('registrations.update-status', $registration) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="cancelled">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Cancel Registration</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to cancel this registration?</p>
                                                    <p><strong>Event:</strong> {{ $registration->event->title }}</p>
                                                    <p><strong>User:</strong> {{ $registration->user->name }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Cancel Registration</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-ticket-alt fa-3x text-muted"></i>
                                </div>
                                <p class="text-muted mb-0">No registrations found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white d-flex justify-content-center">
        {{ $registrations->links() }}
    </div>
</div>
@endsection 