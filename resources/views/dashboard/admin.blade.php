@extends('layouts.admin')

@section('dashboard-title', 'Admin Overview')

@section('dashboard-content')
<!-- Statistics Cards -->
<div class="row g-4 dashboard-stats mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Total Users</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalUsers'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="mt-3 small text-muted">
                    <span class="text-success"><i class="fas fa-arrow-up me-1"></i>{{ $stats['newUsersPercent'] ?? 0 }}%</span> since last month
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Active Events</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['activeEvents'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
                <div class="mt-3 small text-muted">
                    <span class="text-success"><i class="fas fa-arrow-up me-1"></i>{{ $stats['newEventsPercent'] ?? 0 }}%</span> since last month
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Registrations</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalRegistrations'] ?? 0 }}</h2>
                    </div>
                    <div class="card-icon bg-info text-white">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                </div>
                <div class="mt-3 small text-muted">
                    <span class="text-success"><i class="fas fa-arrow-up me-1"></i>{{ $stats['newRegistrationsPercent'] ?? 0 }}%</span> since last month
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Revenue</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalRevenue'] ?? 0 }} DH</h2>
                    </div>
                    <div class="card-icon bg-warning text-white">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>
                <div class="mt-3 small text-muted">
                    <span class="text-success"><i class="fas fa-arrow-up me-1"></i>{{ $stats['revenueGrowthPercent'] ?? 0 }}%</span> since last month
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Platform Activity Chart -->
<div class="card mb-5">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Platform Activity</h5>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="timeRangeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Last 30 Days
                </button>
                <ul class="dropdown-menu" aria-labelledby="timeRangeDropdown">
                    <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 90 Days</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <canvas id="activityChart" style="height: 300px;"></canvas>
    </div>
</div>

<!-- Recent Activities and Pending Approvals -->
<div class="row g-4">
    <!-- Recent Activities -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Recent Activities</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentActivities ?? [] as $activity)
                    <div class="list-group-item px-4 py-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="avatar avatar-sm rounded-circle bg-{{ $activity->type == 'user' ? 'primary' : ($activity->type == 'event' ? 'success' : 'info') }} text-white d-flex align-items-center justify-content-center">
                                    <i class="fas fa-{{ $activity->type == 'user' ? 'user' : ($activity->type == 'event' ? 'calendar' : 'ticket-alt') }}"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <p class="mb-1 fw-bold">{{ $activity->title }}</p>
                                <p class="mb-1 small text-muted">{{ $activity->description }}</p>
                                <p class="mb-0 small text-muted">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item px-4 py-3 text-center">
                        <p class="mb-0 text-muted">No recent activities</p>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 text-center">
                <a href="#" class="btn btn-sm btn-link text-primary">View All Activities</a>
            </div>
        </div>
    </div>
    
    <!-- Pending Approvals -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Pending Approvals</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($pendingApprovals ?? [] as $approval)
                    <div class="list-group-item px-4 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 fw-bold">{{ $approval->title }}</p>
                                <p class="mb-0 small text-muted">Submitted by {{ $approval->user->name }} • {{ $approval->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-sm btn-success me-2"><i class="fas fa-check me-1"></i>Approve</button>
                                <button class="btn btn-sm btn-danger"><i class="fas fa-times me-1"></i>Reject</button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item px-4 py-3 text-center">
                        <p class="mb-0 text-muted">No pending approvals</p>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 text-center">
                <a href="#" class="btn btn-sm btn-link text-primary">View All Approvals</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Platform Activity Chart
        const ctx = document.getElementById('activityChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Users',
                        data: [65, 59, 80, 81, 56, 55, 40, 45, 60, 75, 85, 90],
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        borderColor: 'rgba(13, 110, 253, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: 3
                    },
                    {
                        label: 'Events',
                        data: [28, 48, 40, 19, 86, 27, 90, 85, 72, 68, 75, 82],
                        backgroundColor: 'rgba(25, 135, 84, 0.1)',
                        borderColor: 'rgba(25, 135, 84, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: 3
                    },
                    {
                        label: 'Registrations',
                        data: [45, 25, 40, 62, 70, 75, 80, 95, 85, 92, 102, 115],
                        backgroundColor: 'rgba(13, 202, 240, 0.1)',
                        borderColor: 'rgba(13, 202, 240, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: 3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
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