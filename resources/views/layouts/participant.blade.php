@extends('layouts.main')

@section('title', 'Participant Dashboard - EventORG')

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
    
    .ticket-card {
        border-radius: 15px;
        border: none;
        overflow: hidden;
        transition: all 0.3s;
    }
    
    .ticket-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .ticket-card .card-header {
        padding: 1.5rem;
    }
</style>
@endsection

@section('header')
<div class="container-fluid dashboard-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-4 text-white animated slideInDown mb-3">Participant Dashboard</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Participant Dashboard</li>
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
                            <img src="https://via.placeholder.com/100" class="img-fluid rounded-circle" alt="Participant">
                        </div>
                        <h5 class="mb-1">{{ Auth::check() ? Auth::user()->name : 'Participant' }}</h5>
                        <p class="mb-0">Event Participant</p>
                    </div>
                    <div class="p-2">
                        <nav class="nav flex-column">
                            <a href="{{ route('participant.dashboard') }}" class="nav-link {{ request()->routeIs('participant.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                            <a href="{{ route('participant.events') }}" class="nav-link {{ request()->routeIs('participant.events') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt"></i> My Events
                            </a>
                            <a href="{{ route('participant.tickets') }}" class="nav-link {{ request()->routeIs('participant.tickets') ? 'active' : '' }}">
                                <i class="fas fa-ticket-alt"></i> My Tickets
                            </a>
                            <a href="{{ route('participant.profile') }}" class="nav-link {{ request()->routeIs('participant.profile') ? 'active' : '' }}">
                                <i class="fas fa-user"></i> My Profile
                            </a>
                            <a href="{{ route('events.index') }}" class="nav-link bg-success mt-3">
                                <i class="fas fa-search"></i> Find Events
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="bg-white rounded shadow-sm p-4 mb-4">
                    <h4 class="mb-4">@yield('dashboard-title', 'Participant Overview')</h4>
                    @yield('dashboard-content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection