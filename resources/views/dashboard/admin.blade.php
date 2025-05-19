@extends('layouts.admin')

@section('dashboard-title', 'Admin Overview')

@section('dashboard-content')
<!-- Statistics Cards -->
<div class="row g-4 dashboard-stats mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-0 shadow-sm hover-shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fw-semibold text-muted mb-2">Total Users</h6>
                        <h2 class="display-5 fw-bold mb-0">{{ $stats['totalUsers'] ?? 0 }}</h2>
                    </div>
                    <div class="stat-icon-wrapper bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                </div>
                <div class="mt-3 d-flex align-items-center">
                    <span class="badge bg-success-subtle text-success me-2">
                        <i class="fas fa-arrow-up me-1"></i>{{ $stats['newUsersPercent'] ?? 0 }}%
                    </span>
                    <span class="text-muted small">since last month</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-0 shadow-sm hover-shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fw-semibold text-muted mb-2">Active Events</h6>
                        <h2 class="display-5 fw-bold mb-0">{{ $stats['activeEvents'] ?? 0 }}</h2>
                    </div>
                    <div class="stat-icon-wrapper bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-calendar-alt fa-2x text-success"></i>
                    </div>
                </div>
                <div class="mt-3 d-flex align-items-center">
                    <span class="badge bg-success-subtle text-success me-2">
                        <i class="fas fa-arrow-up me-1"></i>{{ $stats['newEventsPercent'] ?? 0 }}%
                    </span>
                    <span class="text-muted small">since last month</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-0 shadow-sm hover-shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fw-semibold text-muted mb-2">Registrations</h6>
                        <h2 class="display-5 fw-bold mb-0">{{ $stats['totalRegistrations'] ?? 0 }}</h2>
                    </div>
                    <div class="stat-icon-wrapper bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-ticket-alt fa-2x text-info"></i>
                    </div>
                </div>
                <div class="mt-3 d-flex align-items-center">
                    <span class="badge bg-success-subtle text-success me-2">
                        <i class="fas fa-arrow-up me-1"></i>{{ $stats['newRegistrationsPercent'] ?? 0 }}%
                    </span>
                    <span class="text-muted small">since last month</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card border-0 shadow-sm hover-shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fw-semibold text-muted mb-2">Revenue</h6>
                        <h2 class="display-5 fw-bold mb-0">{{ $stats['totalRevenue'] ?? 0 }} DH</h2>
                    </div>
                    <div class="stat-icon-wrapper bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-coins fa-2x text-warning"></i>
                    </div>
                </div>
                <div class="mt-3 d-flex align-items-center">
                    <span class="badge bg-success-subtle text-success me-2">
                        <i class="fas fa-arrow-up me-1"></i>{{ $stats['revenueGrowthPercent'] ?? 0 }}%
                    </span>
                    <span class="text-muted small">since last month</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Platform Activity Chart -->
<div class="card border-0 shadow-sm mb-5">
    <div class="card-header bg-white py-3 border-bottom-0">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">Platform Activity</h5>
            <div class="dropdown">
                <button class="btn btn-soft-primary btn-sm dropdown-toggle" type="button" id="timeRangeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Last 30 Days
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="timeRangeDropdown">
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
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h5 class="mb-0 fw-semibold">Recent Activities</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentActivities ?? [] as $activity)
                    <div class="list-group-item px-4 py-3 border-0">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="activity-icon rounded-circle bg-{{ $activity->type == 'user' ? 'primary' : ($activity->type == 'event' ? 'success' : 'info') }} bg-opacity-10 p-3">
                                    <i class="fas fa-{{ $activity->type == 'user' ? 'user' : ($activity->type == 'event' ? 'calendar' : 'ticket-alt') }} text-{{ $activity->type == 'user' ? 'primary' : ($activity->type == 'event' ? 'success' : 'info') }}"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <p class="mb-1 fw-semibold">{{ $activity->title }}</p>
                                <p class="mb-1 text-muted">{{ $activity->description }}</p>
                                <p class="mb-0 small text-muted">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item px-4 py-5 text-center border-0">
                        <i class="fas fa-inbox fa-2x text-muted mb-3"></i>
                        <p class="mb-0 text-muted">No recent activities</p>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 text-center py-3">
                <a href="#" class="btn btn-link text-primary text-decoration-none">View All Activities</a>
            </div>
        </div>
    </div>
    
    <!-- Pending Approvals -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h5 class="mb-0 fw-semibold">Pending Approvals</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($pendingApprovals ?? [] as $approval)
                    <div class="list-group-item px-4 py-3 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 fw-semibold">{{ $approval->title }}</p>
                                <p class="mb-0 small text-muted">
                                    <i class="fas fa-user-circle me-1"></i>{{ $approval->user->name }} • 
                                    <i class="fas fa-clock ms-2 me-1"></i>{{ $approval->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-soft-success btn-sm px-3">
                                    <i class="fas fa-check me-2"></i>Approve
                                </button>
                                <button class="btn btn-soft-danger btn-sm px-3">
                                    <i class="fas fa-times me-2"></i>Reject
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item px-4 py-5 text-center border-0">
                        <i class="fas fa-clipboard-check fa-2x text-muted mb-3"></i>
                        <p class="mb-0 text-muted">No pending approvals</p>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 text-center py-3">
                <a href="#" class="btn btn-link text-primary text-decoration-none">View All Approvals</a>
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
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Events',
                        data: [28, 48, 40, 19, 86, 27, 90, 85, 72, 68, 75, 82],
                        backgroundColor: 'rgba(25, 135, 84, 0.1)',
                        borderColor: 'rgba(25, 135, 84, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Registrations',
                        data: [45, 25, 40, 62, 70, 75, 80, 95, 85, 92, 102, 115],
                        backgroundColor: 'rgba(13, 202, 240, 0.1)',
                        borderColor: 'rgba(13, 202, 240, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
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
                            drawBorder: false,
                            borderDash: [6],
                            borderDashOffset: [0],
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            padding: 10
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            padding: 10
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            boxWidth: 10,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    });
</script>

<style>
    .stat-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .stat-icon-wrapper {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .activity-icon {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-soft-primary {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border: none;
    }
    
    .btn-soft-success {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
        border: none;
    }
    
    .btn-soft-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: none;
    }
    
    .btn-soft-primary:hover {
        background-color: #0d6efd;
        color: #fff;
    }
    
    .btn-soft-success:hover {
        background-color: #198754;
        color: #fff;
    }
    
    .btn-soft-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
</style>
@endsection