@extends('layouts.organizer')

@section('dashboard-title', 'Statistics Overview')

@section('dashboard-content')
<div class="row g-4">
    <!-- Total Events Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-primary">Total Events</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalEvents'] }}</h2>
                    </div>
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Events Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-success">Active Events</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['activeEvents'] }}</h2>
                    </div>
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Registrations Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-info">Total Registrations</h6>
                        <h2 class="display-6 fw-bold">{{ $stats['totalRegistrations'] }}</h2>
                    </div>
                    <div class="card-icon bg-info text-white">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Revenue Card -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-warning">Total Revenue</h6>
                        <h2 class="display-6 fw-bold">{{ number_format($stats['totalRevenue'], 2) }} DH</h2>
                    </div>
                    <div class="card-icon bg-warning text-white">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Monthly Registrations Chart -->
<div class="card mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">Monthly Registrations</h5>
    </div>
    <div class="card-body">
        <canvas id="monthlyRegistrationsChart" style="height: 300px;"></canvas>
    </div>
</div>

@endsection

@push('styles')
<style>
    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const monthlyData = @json($monthlyData);
        
        // Process data for the chart
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const counts = Array(12).fill(0);
        
        monthlyData.forEach(data => {
            counts[data.month - 1] = data.count;
        });

        // Create the chart
        const ctx = document.getElementById('monthlyRegistrationsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Registrations',
                    data: counts,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Registrations'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Registration Trends'
                    }
                }
            }
        });
    });
</script>
@endpush 