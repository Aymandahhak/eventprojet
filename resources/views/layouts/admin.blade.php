@extends('layouts.main')

@section('title', 'Admin Dashboard - EventORG')

@section('styles')
<style>
    .dashboard-sidebar {
        background-color: var(--bs-dark);
        min-height: calc(100vh - 70px);
    }
    
    .dashboard-sidebar .nav-link {
        color: #fff;
        border-radius: 0;
        padding: 0.75rem 1.25rem;
    }
    
    .dashboard-sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .dashboard-sidebar .nav-link.active {
        background-color: var(--bs-primary);
        color: #fff;
    }
    
    .dashboard-sidebar .nav-link i {
        width: 20px;
        text-align: center;
        margin-right: 10px;
    }
    
    .dashboard-header {
        background-color: var(--bs-primary);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }
    
    .dashboard-stats .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transition: all 0.3s;
    }
    
    .dashboard-stats .card:hover {
        transform: translateY(-5px);
    }
    
    .dashboard-stats .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
</style>
@endsection

@section('header')
<div class="container-fluid dashboard-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-4 text-white animated slideInDown mb-3">Admin Dashboard</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="dashboard-sidebar rounded shadow-sm">
                    <div class="p-4 text-center bg-primary text-white">
                        <div class="mb-3">
                            <img src="https://via.placeholder.com/100" class="img-fluid rounded-circle" alt="Admin">
                        </div>
                        <h5 class="mb-1">{{ Auth::check() ? Auth::user()->name : 'Administrator' }}</h5>
                        <p class="mb-0">Admin</p>
                    </div>
                    <div class="p-2">
                        <nav class="nav flex-column">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                            <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                                <i class="fas fa-users"></i> Users
                            </a>
                            <a href="{{ route('admin.events.index') }}" class="nav-link {{ request()->routeIs('admin.events') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt"></i> Events
                            </a>
                            <a href="{{route('admin.registrations.index')}}" class="nav-link {{ request()->routeIs('admin.registrations') ? 'active' : '' }}">
                                <i class="fas fa-ticket-alt"></i> Registrations
                            </a>
                             <a href="{{ route('admin.statistics.index') }}" class="nav-link {{ request()->routeIs('admin.statistics.index') ? 'active' : '' }}">
                                <i class="fas fa-chart-bar"></i> Statistics
                            </a>


                            
                            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="bg-white rounded shadow-sm p-4 mb-4">
                    <h4 class="mb-4">@yield('dashboard-title', 'Overview')</h4>
                    @yield('dashboard-content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection