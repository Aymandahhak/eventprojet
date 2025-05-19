@extends('layouts.organizer')

@section('dashboard-content')
<div class="content-card mb-5">
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

        <div class="d-flex justify-content-between align-items-center p-4">
            <h5 class="mb-0">Manage Events</h5>
            <a href="{{ route('organizer.events.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New Event
            </a>
        </div>

<!-- Top Action Bar -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-6">
                <form action="{{ route('organizer.events') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search events..." name="search" value="{{ request()->search }}">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('organizer.events', ['status' => 'all']) }}">All Events</a></li>
                        <li><a class="dropdown-item" href="{{ route('organizer.events', ['status' => 'published']) }}">Published Only</a></li>
                        <li><a class="dropdown-item" href="{{ route('organizer.events', ['status' => 'draft']) }}">Drafts Only</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('organizer.events', ['time' => 'upcoming']) }}">Upcoming Events</a></li>
                        <li><a class="dropdown-item" href="{{ route('organizer.events', ['time' => 'past']) }}">Past Events</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Events List -->
<div class="card">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">My Events</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4" style="width: 40%">Event</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Registrations</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events ?? [] as $event)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;" alt="{{ $event->title }}">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-calendar-day fa-2x text-primary"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-1">{{ $event->title }}</h6>
                                    <p class="mb-0 small text-muted">{{ $event->category }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p class="mb-0"><i class="far fa-calendar-alt text-primary me-1"></i> {{ $event->date->format('M d, Y') }}</p>
                                <p class="mb-0 small text-muted"><i class="far fa-clock text-primary me-1"></i> {{ $event->time }}</p>
                            </div>
                        </td>
                        <td>
                            @if($event->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-warning">Draft</span>
                            @endif
                            
                            @if($event->date < now())
                                <span class="badge bg-secondary ms-1">Past</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-2">
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $event->registrations_count ?? 0 }}
                                    </span>
                                </div>
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    @php
                                        $percentage = $event->max_participants 
                                            ? min(100, (($event->registrations_count ?? 0) / $event->max_participants) * 100) 
                                            : 0;
                                    @endphp
                                    <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            @if($event->max_participants)
                                <small class="text-muted">{{ $event->registrations_count ?? 0 }}/{{ $event->max_participants }} participants</small>
                            @else
                                <small class="text-muted">Unlimited capacity</small>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $event->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            
                            <!-- Dropdown for more actions -->
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle ms-1" type="button" id="eventActionsDropdown{{ $event->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="eventActionsDropdown{{ $event->id }}">
                                    <li><a class="dropdown-item" href="{{ route('organizer.events.registrations', $event) }}"><i class="fas fa-users me-2"></i>Manage Registrations</a></li>
                                    <li><a class="dropdown-item" href="{{ route('organizer.events.statistics', $event) }}"><i class="fas fa-chart-bar me-2"></i>View Statistics</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    @if($event->is_published)
                                        <li>
                                            <form action="{{ route('events.unpublish', $event) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="dropdown-item"><i class="fas fa-eye-slash me-2"></i>Unpublish</button>
                                            </form>
                                        </li>
                                    @else
                                        <li>
                                            <form action="{{ route('events.publish', $event) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="dropdown-item"><i class="fas fa-globe me-2"></i>Publish</button>
                                            </form>
                                        </li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('events.duplicate', $event) }}"><i class="fas fa-copy me-2"></i>Duplicate</a></li>
                                </ul>
                            </div>
                            
                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $event->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $event->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $event->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <p>Are you sure you want to delete <strong>{{ $event->title }}</strong>?</p>
                                            <p class="text-danger mb-0">This action cannot be undone and will remove all registrations for this event.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete Event</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <p class="mb-0 text-muted">No events found</p>
                            <a href="{{ route('events.create') }}" class="btn btn-primary rounded-pill mt-3">Create Your First Event</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(isset($events) && $events->hasPages())
    <div class="card-footer bg-white py-3">
        {{ $events->links() }}
    </div>
    @endif
</div>

<!-- Event Statistics Overview -->
<div class="card mt-4">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Events Performance Overview</h5>
    </div>
    <div class="card-body">
        <canvas id="eventsPerformanceChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Performance Chart
        const ctx = document.getElementById('eventsPerformanceChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! isset($performanceData) ? json_encode($performanceData['labels'] ?? []) : '["No Data Available"]' !!},
                datasets: [
                    {
                        label: 'Registrations',
                        data: {!! isset($performanceData) ? json_encode($performanceData['registrations'] ?? []) : '[0]' !!},
                        backgroundColor: 'rgba(13, 110, 253, 0.5)',
                        borderColor: 'rgba(13, 110, 253, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Revenue (DH)',
                        data: {!! isset($performanceData) ? json_encode($performanceData['revenue'] ?? []) : '[0]' !!},
                        backgroundColor: 'rgba(25, 135, 84, 0.5)',
                        borderColor: 'rgba(25, 135, 84, 1)',
                        borderWidth: 1,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Registrations'
                        }
                    },
                    y1: {
                        position: 'right',
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Revenue (DH)'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end'
                    }
                }
            }
        });
    });
</script>
@endsection 