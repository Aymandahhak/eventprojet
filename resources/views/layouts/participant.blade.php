@extends('layouts.main')

@section('title', 'Participant Dashboard - EventORG')

@section('styles')
<style>
    /* Modern sidebar styling */
    .dashboard-sidebar {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
        border-radius: 15px;
        min-height: calc(100vh - 70px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
    }
    
    .dashboard-sidebar::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.2);
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
    }
    
    .dashboard-sidebar .avatar-container {
        position: relative;
        width: 110px;
        height: 110px;
        margin: 0 auto 1rem;
    }
    
    .dashboard-sidebar .avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.3);
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .dashboard-sidebar .avatar-container::after {
        content: "";
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        border-radius: 50%;
        border: 2px solid #fff;
        opacity: 0.3;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 0.3;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.2;
        }
        100% {
            transform: scale(1);
            opacity: 0.3;
        }
    }
    
    .dashboard-sidebar .nav-link {
        color: rgba(255, 255, 255, 0.85);
        border-radius: 8px;
        margin: 0.3rem 1rem;
        padding: 0.85rem 1.25rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        overflow: hidden;
    }
    
    .dashboard-sidebar .nav-link::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        z-index: -1;
    }
    
    .dashboard-sidebar .nav-link:hover {
        color: #fff;
        transform: translateX(5px);
    }
    
    .dashboard-sidebar .nav-link:hover::before {
        width: 100%;
    }
    
    .dashboard-sidebar .nav-link.active {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .dashboard-sidebar .nav-link i {
        width: 24px;
        text-align: center;
        margin-right: 10px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    
    .dashboard-sidebar .nav-link:hover i {
        transform: translateY(-2px);
    }
    
    .dashboard-sidebar .find-events-btn {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        border-radius: 30px;
        padding: 0.75rem 1.5rem;
        margin: 1.5rem 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .dashboard-sidebar .find-events-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .dashboard-sidebar .find-events-btn i {
        margin-right: 8px;
    }
    
    /* Creative header styling */
    .dashboard-header {
        background: url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center center;
        background-size: cover;
        padding: 4rem 0;
        margin-bottom: 2.5rem;
        position: relative;
        border-radius: 0 0 60px 60px;
        overflow: hidden;
    }
    
    .dashboard-header::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(26, 42, 108, 0.9), rgba(178, 31, 31, 0.7), rgba(253, 187, 45, 0.8));
        z-index: 0;
    }
    
    .dashboard-header .container {
        position: relative;
        z-index: 1;
    }
    
    .dashboard-header h1 {
        font-weight: 800;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        position: relative;
    }
    
    .dashboard-header h1::after {
        content: "";
        position: absolute;
        bottom: -15px;
        left: 0;
        width: 80px;
        height: 4px;
        background: #fff;
        border-radius: 2px;
    }
    
    .dashboard-header .breadcrumb {
        background: rgba(255, 255, 255, 0.15);
        padding: 0.75rem 1.5rem;
        border-radius: 30px;
        display: inline-flex;
        margin-top: 1.5rem;
    }
    
    .dashboard-header .breadcrumb-item,
    .dashboard-header .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.9);
    }
    
    .dashboard-header .breadcrumb-item.active {
        color: #fff;
        font-weight: 600;
    }
    
    .dashboard-header .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.7);
    }
    
    /* Stats cards styling */
    .dashboard-stats .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
        overflow: hidden;
    }
    
    .dashboard-stats .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }
    
    .dashboard-stats .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    /* Ticket cards styling */
    .ticket-card {
        border-radius: 15px;
        border: none;
        overflow: hidden;
        transition: all 0.3s;
    }
    
    .ticket-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }
    
    .ticket-card .card-header {
        padding: 1.5rem;
    }
    
    /* Main content area */
    .main-content {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    
    .main-content .content-header {
        border-bottom: 1px solid #eee;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }
</style>
@endsection

@section('header')
<div class="container-fluid dashboard-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-4 text-white animated slideInDown mb-4">Tableau de Bord Participant</h1>
                <p class="text-white mb-4 animated slideInDown">Bienvenue dans votre espace personnel. Gérez vos événements, billets et profil en toute simplicité.</p>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tableau de Bord Participant</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-5 d-none d-lg-block animated slideInRight">
                <div class="position-relative">
                    <img src="{{ asset('asset/img/dashboard-illustration.svg') }}" alt="Dashboard" class="img-fluid" onerror="this.style.display='none'">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="dashboard-sidebar rounded">
                    <div class="user-profile">
                        <div class="avatar-container">
                            <img src="{{ Auth::user()->avatar ? asset('asset/img/profiles/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random&color=fff&size=100' }}" class="avatar" alt="{{ Auth::user()->name }}">
                        </div>
                        <h5 class="text-white mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-white-50 mb-3"><i class="fas fa-check-circle me-1"></i>Participant</p>
                        <div class="d-flex justify-content-center">
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-calendar-check me-1"></i> {{ Auth::user()->registrations()->count() }} événements
                            </span>
                        </div>
                    </div>
                    <div class="nav-wrapper p-2">
                        <nav class="nav flex-column mt-2">
                            <a href="{{ route('participant.dashboard') }}" class="nav-link {{ request()->routeIs('participant.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i> Tableau de Bord
                            </a>
                            <a href="{{ route('participant.events') }}" class="nav-link {{ request()->routeIs('participant.events') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt"></i> Mes Événements
                            </a>
                            <a href="{{ route('participant.tickets') }}" class="nav-link {{ request()->routeIs('participant.tickets') ? 'active' : '' }}">
                                <i class="fas fa-ticket-alt"></i> Mes Billets
                            </a>
                            <a href="{{ route('participant.profile') }}" class="nav-link {{ request()->routeIs('participant.profile') ? 'active' : '' }}">
                                <i class="fas fa-user"></i> Mon Profil
                            </a>
                        </nav>
                        <a href="{{ route('events.index') }}" class="find-events-btn">
                            <i class="fas fa-search"></i> Découvrir des Événements
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main-content p-4 mb-4">
                    <div class="content-header">
                        <h4 class="mb-0">@yield('dashboard-title', 'Vue d\'ensemble')</h4>
                    </div>
                    @yield('dashboard-content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection