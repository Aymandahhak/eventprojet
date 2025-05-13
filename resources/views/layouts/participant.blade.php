@extends('layouts.main')

@section('title', 'Participant Dashboard - EventORG')

@section('styles')
<style>
    /* Modern Navigation Bar styling */
    .nav-bar {
        background-color: #fff;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        z-index: 100;
    }
    
    .navbar-brand h1 {
        margin-bottom: 0;
        color: #333;
        transition: all 0.3s;
    }
    
    .navbar-brand:hover h1 {
        transform: scale(1.05);
    }
    
    .nav-item {
        padding: 0 0.75rem;
        position: relative;
    }
    
    .nav-link {
        color: #555 !important;
        font-weight: 500;
        padding: 25px 0;
        transition: all 0.3s;
        position: relative;
    }
    
    .nav-link:hover,
    .nav-link.active {
        color: #607EBC !important;
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 20px;
        left: 0;
        background-color: #607EBC;
        transition: width 0.3s;
    }
    
    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }
    
    .dropdown-menu {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        padding: 1rem 0;
    }
    
    .dropdown-item {
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        color: #555;
        transition: all 0.3s;
    }
    
    .dropdown-item:hover {
        color: #607EBC;
        background-color: rgba(96, 126, 188, 0.1);
    }
    
    .dropdown-item i {
        margin-right: 0.5rem;
        color: #607EBC;
    }

    /* Modern sidebar styling */
    .dashboard-sidebar {
        background: linear-gradient(135deg, #6259ca 0%, #8a79fa 100%);
        border-radius: 20px;
        min-height: calc(100vh - 70px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .dashboard-sidebar::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        z-index: 0;
    }
    
    .dashboard-sidebar .user-profile {
        position: relative;
        z-index: 1;
        padding: 2.5rem 1.5rem;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .dashboard-sidebar .nav-wrapper {
        position: relative;
        z-index: 1;
        padding-top: 1rem;
    }
    
    .dashboard-sidebar .avatar-container {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 1rem;
        perspective: 800px;
    }
    
    .dashboard-sidebar .avatar {
        width: 100px;
        height: 100px;
        border-radius: 20px;
        border: 4px solid rgba(255, 255, 255, 0.2);
        object-fit: cover;
        transition: all 0.5s ease;
        transform: rotateY(0);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    .dashboard-sidebar .avatar-container:hover .avatar {
        transform: rotateY(10deg);
        border-color: rgba(255, 255, 255, 0.4);
    }
    
    .dashboard-sidebar .avatar-container::after {
        content: "";
        position: absolute;
        top: 5px;
        left: 5px;
        right: 5px;
        bottom: 5px;
        border-radius: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        opacity: 0;
        transform: scale(1.1);
        transition: all 0.3s ease;
    }
    
    .dashboard-sidebar .avatar-container:hover::after {
        opacity: 1;
        transform: scale(1);
    }
    
    .dashboard-sidebar .nav-link {
        color: rgba(255, 255, 255, 0.85);
        border-radius: 12px;
        margin: 0.5rem 1rem;
        padding: 0.85rem 1.25rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    
    .dashboard-sidebar .nav-link::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.5s ease;
        z-index: -1;
    }
    
    .dashboard-sidebar .nav-link:hover {
        color: #fff;
        transform: translateX(5px);
    }
    
    .dashboard-sidebar .nav-link:hover::before {
        left: 0;
    }
    
    .dashboard-sidebar .nav-link.active {
        background: #fff;
        color: #6259ca;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        font-weight: 600;
    }
    
    .dashboard-sidebar .nav-link.active i {
        color: #6259ca;
    }
    
    .dashboard-sidebar .nav-link i {
        width: 24px;
        text-align: center;
        margin-right: 12px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    
    .dashboard-sidebar .nav-link:hover i {
        transform: translateY(-2px);
    }
    
    .dashboard-sidebar .find-events-btn {
        background: #fff;
        color: #6259ca;
        border-radius: 12px;
        padding: 0.85rem 1.5rem;
        margin: 1.5rem 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .dashboard-sidebar .find-events-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .dashboard-sidebar .find-events-btn i {
        margin-right: 10px;
        transition: all 0.3s ease;
    }
    
    .dashboard-sidebar .find-events-btn:hover i {
        transform: translateX(-3px);
    }
    
    /* Creative header styling */
    .dashboard-header {
        background: linear-gradient(to right, #6259ca, #8a79fa);
        padding: 3rem 0 6rem;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-header::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        z-index: 0;
    }
    
    .dashboard-header .container {
        position: relative;
        z-index: 1;
    }
    
    .dashboard-header .particle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
    }
    
    .dashboard-header .particle:nth-child(1) {
        top: 20%;
        left: 10%;
        width: 80px;
        height: 80px;
        animation: float 8s infinite ease-in-out;
    }
    
    .dashboard-header .particle:nth-child(2) {
        top: 60%;
        left: 20%;
        width: 120px;
        height: 120px;
        animation: float 12s infinite ease-in-out;
    }
    
    .dashboard-header .particle:nth-child(3) {
        top: 10%;
        right: 15%;
        width: 100px;
        height: 100px;
        animation: float 10s infinite ease-in-out;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(10deg);
        }
    }
    
    .dashboard-header h1 {
        font-weight: 800;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
        font-size: 2.5rem;
    }
    
    .dashboard-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 600px;
        margin-bottom: 1.5rem;
    }
    
    .dashboard-header .breadcrumb {
        background: rgba(255, 255, 255, 0.1);
        display: inline-flex;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
    }
    
    .dashboard-header .breadcrumb-item {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 500;
    }
    
    .dashboard-header .breadcrumb-item.active {
        color: #fff;
    }
    
    .dashboard-header .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.6);
    }
</style>
@endsection

@section('content')
<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar sticky-top px-4 py-2 py-lg-0">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a href="{{ url('/') }}" class="navbar-brand p-0">
            <h1 class="display-6 text-dark"><i class="fas fa-calendar-alt text-primary me-3"></i>EventORG</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{ url('/') }}" class="nav-item nav-link">Home</a>
                <a href="{{ route('participant.dashboard') }}" class="nav-item nav-link {{ request()->routeIs('participant.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('participant.events') }}" class="nav-item nav-link {{ request()->routeIs('participant.events') ? 'active' : '' }}">My Events</a>
                <a href="{{ route('participant.tickets') }}" class="nav-item nav-link {{ request()->routeIs('participant.tickets') ? 'active' : '' }}">My Tickets</a>
                <a href="{{ route('events.index') }}" class="nav-item nav-link">Browse Events</a>
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user-circle me-2"></i>My Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('participant.tickets') }}"><i class="fas fa-ticket-alt me-2"></i>My Tickets</a></li>
                        <li><a class="dropdown-item" href="{{ route('participant.events') }}"><i class="fas fa-calendar-alt me-2"></i>My Events</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

<div class="container-fluid dashboard-section py-5">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="dashboard-sidebar">
                    <div class="user-profile">
                        <div class="avatar-container">
                            <div class="avatar">
                                <i class="fas fa-user fa-3x" style="color: #fff; line-height: 92px;"></i>
                            </div>
                        </div>
                        <h5 class="text-white mt-3">{{ Auth::user()->name }}</h5>
                        <p class="text-white-50 mb-0">{{ Auth::user()->email }}</p>
                    </div>
                    
                    <div class="nav-wrapper">
                        <a href="{{ route('participant.dashboard') }}" class="nav-link {{ request()->routeIs('participant.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('participant.events') }}" class="nav-link {{ request()->routeIs('participant.events') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check"></i>
                            My Events
                        </a>
                        
                        <a href="{{ route('participant.tickets') }}" class="nav-link {{ request()->routeIs('participant.tickets') ? 'active' : '' }}">
                            <i class="fas fa-ticket-alt"></i>
                            My Tickets
                        </a>
                        
                        <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <i class="fas fa-user-edit"></i>
                            Edit Profile
                        </a>
                        
                        <a href="{{ route('events.index') }}" class="find-events-btn">
                            <i class="fas fa-search"></i>
                            Find Events
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9">
                @if (request()->routeIs('participant.dashboard') || request()->routeIs('participant.events') || request()->routeIs('participant.tickets'))
                <div class="dashboard-header mb-4">
                    <div class="container">
                        <div class="particle"></div>
                        <div class="particle"></div>
                        <div class="particle"></div>
                        <h1 class="text-white">@yield('dashboard-title', 'Dashboard')</h1>
                        <p class="text-white">Welcome to your personalized event management dashboard.</p>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('participant.dashboard') }}" class="text-white">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('dashboard-title', 'Overview')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                @endif
                
                @yield('dashboard-content')
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation for sidebar links
    const navLinks = document.querySelectorAll('.dashboard-sidebar .nav-link');
    navLinks.forEach((link, index) => {
        link.style.opacity = '0';
        link.style.transform = 'translateX(-10px)';
        
        setTimeout(() => {
            link.style.transition = 'all 0.5s ease';
            link.style.opacity = '1';
            link.style.transform = 'translateX(0)';
        }, 100 + (index * 100));
    });
    
    // Custom scrollbar initialization
    // Add your scrollbar initialization here if needed
});
</script>
@yield('dashboard-scripts')
@endsection