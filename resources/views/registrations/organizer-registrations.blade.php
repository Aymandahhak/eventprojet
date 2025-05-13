@extends('layouts.organizer')

@section('dashboard-title', 'Event Registrations')

@section('dashboard-content')
<div class="content-card mb-5">
    <div class="content-header">
        <h5>Registrations for {{ $event->title }}</h5>
        <a href="{{ route('organizer.events') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Back to Events
        </a>
    </div>
    
    <div class="content-body no-padding">
        @if(session('success'))
            <div class="alert-custom alert-success mb-0 mx-4 mt-4">
                <i class="fas fa-check-circle me-2"></i>
                <span>{{ session('success') }}</span>
                <button class="alert-close"><i class="fas fa-times"></i></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert-custom alert-danger mb-0 mx-4 mt-4">
                <i class="fas fa-exclamation-circle me-2"></i>
                <span>{{ session('error') }}</span>
                <button class="alert-close"><i class="fas fa-times"></i></button>
            </div>
        @endif
        
        <div class="registration-stats p-4">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stat-card stat-primary h-100">
                        <div class="stat-card-inner">
                            <div class="stat-content">
                                <h6>Total Registrations</h6>
                                <h2 class="stat-value">{{ $registrations->total() }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-success h-100">
                        <div class="stat-card-inner">
                            <div class="stat-content">
                                <h6>Confirmed</h6>
                                <h2 class="stat-value">{{ $registrations->where('status', 'confirmed')->count() }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-warning h-100">
                        <div class="stat-card-inner">
                            <div class="stat-content">
                                <h6>Pending</h6>
                                <h2 class="stat-value">{{ $registrations->where('status', 'pending')->count() }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-danger h-100">
                        <div class="stat-card-inner">
                            <div class="stat-content">
                                <h6>Cancelled</h6>
                                <h2 class="stat-value">{{ $registrations->where('status', 'cancelled')->count() }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-ban"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover registrations-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Attendee</th>
                        <th>Date</th>
                        <th>Tickets</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $index => $registration)
                    <tr>
                        <td>{{ $index + 1 + ($registrations->currentPage() - 1) * $registrations->perPage() }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $registration->user->name }}</h6>
                                    <small class="text-muted">{{ $registration->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ $registration->created_at->format('d/m/Y') }}<br>
                            <small class="text-muted">{{ $registration->created_at->format('H:i') }}</small>
                        </td>
                        <td>{{ $registration->ticket_quantity }}</td>
                        <td>{{ number_format($registration->total_price, 2) }} €</td>
                        <td>
                            <span class="badge status-{{ $registration->status }}">
                                {{ ucfirst($registration->status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge payment-{{ $registration->payment_status }}">
                                {{ ucfirst($registration->payment_status) }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                @if($registration->status !== 'confirmed' && $registration->status !== 'cancelled')
                                <form action="{{ route('registrations.update-status', $registration) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="btn btn-success btn-sm" title="Confirm Registration">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                
                                @if($registration->status !== 'cancelled')
                                <form action="{{ route('registrations.update-status', $registration) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn btn-danger btn-sm" title="Cancel Registration">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @endif
                                
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#registrationModal{{ $registration->id }}" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            
                            <!-- Registration Modal -->
                            <div class="modal fade" id="registrationModal{{ $registration->id }}" tabindex="-1" aria-labelledby="registrationModalLabel{{ $registration->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="registrationModalLabel{{ $registration->id }}">Registration Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ticket-details">
                                                <div class="ticket-card mb-0">
                                                    <div class="ticket-header">
                                                        <div class="ticket-logo">
                                                            <i class="fas fa-ticket-alt"></i>
                                                        </div>
                                                        <div class="ticket-code">
                                                            {{ $registration->ticket_code }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="ticket-body">
                                                        <h5 class="mb-4">User Information</h5>
                                                        <div class="ticket-info mb-4">
                                                            <div class="info-item">
                                                                <span class="label">Name</span>
                                                                <span class="value">{{ $registration->user->name }}</span>
                                                            </div>
                                                            <div class="info-item">
                                                                <span class="label">Email</span>
                                                                <span class="value">{{ $registration->user->email }}</span>
                                                            </div>
                                                            @if($registration->user->phone)
                                                            <div class="info-item">
                                                                <span class="label">Phone</span>
                                                                <span class="value">{{ $registration->user->phone }}</span>
                                                            </div>
                                                            @endif
                                                            @if($registration->user->address)
                                                            <div class="info-item">
                                                                <span class="label">Address</span>
                                                                <span class="value">{{ $registration->user->address }}</span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        
                                                        <h5 class="mb-4">Registration Details</h5>
                                                        <div class="ticket-info mb-4">
                                                            <div class="info-item">
                                                                <span class="label">Registration Date</span>
                                                                <span class="value">{{ $registration->created_at->format('d/m/Y H:i') }}</span>
                                                            </div>
                                                            <div class="info-item">
                                                                <span class="label">Ticket Quantity</span>
                                                                <span class="value">{{ $registration->ticket_quantity }}</span>
                                                            </div>
                                                            <div class="info-item">
                                                                <span class="label">Total Price</span>
                                                                <span class="value">{{ number_format($registration->total_price, 2) }} €</span>
                                                            </div>
                                                            <div class="info-item">
                                                                <span class="label">Status</span>
                                                                <span class="value status-{{ $registration->status }}">{{ ucfirst($registration->status) }}</span>
                                                            </div>
                                                            <div class="info-item">
                                                                <span class="label">Payment Status</span>
                                                                <span class="value payment-{{ $registration->payment_status }}">{{ ucfirst($registration->payment_status) }}</span>
                                                            </div>
                                                            @if($registration->payment_id)
                                                            <div class="info-item">
                                                                <span class="label">Payment ID</span>
                                                                <span class="value">{{ $registration->payment_id }}</span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Close</button>
                                            
                                            @if($registration->status !== 'confirmed' && $registration->status !== 'cancelled')
                                            <form action="{{ route('registrations.update-status', $registration) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-check me-2"></i>Confirm Registration
                                                </button>
                                            </form>
                                            @endif
                                            
                                            @if($registration->status !== 'cancelled')
                                            <form action="{{ route('registrations.update-status', $registration) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-ban me-2"></i>Cancel Registration
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-clipboard"></i>
                                </div>
                                <p>No registrations found for this event</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="pagination-container">
            {{ $registrations->links() }}
        </div>
    </div>
</div>

<style>
/* Table Styling */
.registrations-table {
    width: 100%;
    margin: 0;
}

.registrations-table th, 
.registrations-table td {
    padding: 1rem;
    vertical-align: middle;
}

.registrations-table th {
    font-weight: 600;
    color: #555;
    background: rgba(0,0,0,0.02);
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.registrations-table tr {
    transition: all 0.2s ease;
}

.registrations-table tr:hover {
    background: rgba(0,0,0,0.01);
}

.avatar-circle {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #6259ca;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.action-buttons {
    display: flex;
    gap: 0.25rem;
}

/* Modal Styling */
.modal-content {
    border-radius: 16px;
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.modal-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.modal-footer {
    padding: 1.25rem 1.5rem;
    border-top: 1px solid rgba(0,0,0,0.05);
}

/* Status Colors */
.stat-danger {
    background: linear-gradient(135deg, #f5365c 0%, #f56036 100%);
    color: #fff;
}

/* Additional Status Badge Colors */
.badge {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
}
</style>

<script>
    // Alert close functionality
    document.addEventListener('DOMContentLoaded', function() {
        const alertCloseButtons = document.querySelectorAll('.alert-close');
        alertCloseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const alert = this.closest('.alert-custom');
                alert.style.opacity = '0';
                setTimeout(() => alert.style.display = 'none', 300);
            });
        });
    });
</script>
@endsection 