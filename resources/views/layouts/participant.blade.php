<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Participant Dashboard - EventORG')</title>

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('asset/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    
    <!-- Feather Icons -->
    <link href="https://unpkg.com/feather-icons/dist/feather.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">

    @yield('styles')
    
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #D1E0D7;
            color: #333;
            overflow-x: hidden;
        }
        
        /* Left Sidebar Navigation */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 250px;
            background: linear-gradient(180deg, #607EBC 0%, #D1E0D7 100%);
            color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header h1 {
            margin: 0;
            font-size: 1.5rem;
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }
        
        .sidebar-brand-icon {
            color: #fff;
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .sidebar-nav {
            padding: 20px 0;
        }
        
        .sidebar-nav .nav-item {
            position: relative;
        }
        
        .sidebar .nav-link {
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .sidebar .nav-link i {
            margin-right: 12px;
            font-size: 1.2rem;
            width: 20px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-left-color: #D1E0D7;
        }
        
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            border-left-color: #D1E0D7;
        }
        
        .sidebar .nav-link:hover i,
        .sidebar .nav-link.active i {
            transform: translateX(3px);
        }
        
        .sidebar-user {
            padding: 15px 20px;
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.2);
        }
        
        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            color: #607EBC;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 10px;
        }
        
        .sidebar-user-info {
            flex: 1;
            overflow: hidden;
        }
        
        .sidebar-user-name {
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .sidebar-user-role {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
        }
        
        .sidebar-user-dropdown {
            color: #fff;
            cursor: pointer;
            padding: 5px;
            transition: all 0.2s;
        }
        
        .sidebar-user-dropdown:hover {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        /* Main Content Area */
        .main-content {
            margin-left: 250px;
            transition: all 0.3s ease;
            min-height: 100vh;
            background: #D1E0D7;
            padding-top: 20px;
        }
        
        /* Mobile Navigation Toggle */
        .menu-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1001;
            background: #607EBC;
            color: #fff;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
        
        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            padding: 1rem 0;
            min-width: 200px;
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            color: #555;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .dropdown-item:hover {
            color: #607EBC;
            background-color: rgba(96, 126, 188, 0.1);
        }
        
        .dropdown-item i {
            margin-right: 0.5rem;
            color: #607EBC;
            width: 16px;
        }
        
        /* Welcome section */
        .welcome-section {
            background-color: #fff;
            border-radius: 16px;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .welcome-heading {
            color: #607EBC;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .welcome-subtext {
            color: #555;
            margin-bottom: 0;
        }
        
        /* Profile Card */
        .profile-header {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .profile-avatar-container {
            position: relative;
            margin-right: 30px;
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #607EBC 0%, #D1E0D7 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(96, 126, 188, 0.6);
        }
        
        .profile-info {
            flex-grow: 1;
        }
        
        .profile-name {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: #607EBC;
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        
        .profile-role {
            color: #607EBC;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 15px;
        }
        
        .events-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 15px;
            background: rgba(209, 224, 215, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .events-badge i {
            color: #607EBC;
            margin-right: 8px;
        }
        
        .events-count {
            font-weight: 700;
            color: #607EBC;
        }
        
        .profile-actions {
            display: flex;
            margin-left: auto;
            align-items: center;
        }
        
        @media (max-width: 768px) {
            .profile-actions {
                margin-left: 0;
                margin-top: 20px;
                width: 100%;
            }
            
            .profile-avatar-container {
                margin-right: 20px;
            }
            
            .profile-avatar {
                width: 60px;
                height: 60px;
                font-size: 1.4rem;
            }
        }
        
        .btn-edit-profile {
            padding: 10px 20px;
            background: #607EBC;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-edit-profile:hover {
            background: #4a63a0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(96, 126, 188, 0.3);
            color: white;
        }
        
        .btn-edit-profile i {
            margin-right: 8px;
        }
        
        /* Statistics Cards Styling */
        .stat-card {
            border-radius: 16px;
            overflow: hidden;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: none;
            position: relative;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.8rem;
        }
        
        .stat-primary {
            background: linear-gradient(135deg, #607EBC 0%, #879FD4 100%);
            color: #fff;
        }
        
        .stat-success {
            background: linear-gradient(135deg, #607EBC 0%, #D1E0D7 100%);
            color: #fff;
        }
        
        .stat-info {
            background: linear-gradient(135deg, #607EBC 0%, #98AACF 100%);
            color: #fff;
        }
        
        .stat-warning {
            background: linear-gradient(135deg, #607EBC 0%, #CCD9EC 100%);
            color: #fff;
        }
        
        .stat-content h6 {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }
        
        .stat-link, .stat-info {
            font-size: 0.85rem;
            opacity: 0.9;
            color: inherit;
            text-decoration: none;
            display: block;
        }
        
        .stat-link:hover {
            text-decoration: underline;
            color: #fff;
        }
        
        .stat-link i {
            transition: transform 0.3s ease;
            margin-left: 0.25rem;
        }
        
        .stat-link:hover i {
            transform: translateX(3px);
        }
        
        .stat-icon {
            font-size: 2.2rem;
            opacity: 0.9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 60px;
            width: 60px;
            background: rgba(255,255,255,0.15);
            border-radius: 12px;
            backdrop-filter: blur(5px);
        }
        
        /* Event Cards */
        .event-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            margin-bottom: 25px;
            border: none;
            background: white;
        }
        
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .event-image {
            height: 180px;
            position: relative;
            overflow: hidden;
        }
        
        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .event-card:hover .event-image img {
            transform: scale(1.05);
        }
        
        .event-body {
            padding: 20px;
        }
        
        .event-date {
            color: #607EBC;
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
        }
        
        .event-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #607EBC;
        }
        
        .event-location {
            color: #666;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }
        
        .event-location i {
            margin-right: 8px;
            color: #607EBC;
        }
        
        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .event-price {
            font-weight: 700;
            color: #607EBC;
        }
        
        .btn-view {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .section-title {
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
            color: #607EBC;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: #607EBC;
            border-radius: 10px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .stat-card {
                margin-bottom: 20px;
            }
        }
        
        @media (max-width: 768px) {
            .main-container {
                padding: 20px 0;
            }
            
            .profile-header {
                padding: 20px;
            }
            
            .stat-card-inner {
                padding: 1.3rem;
            }
            
            .stat-value {
                font-size: 1.6rem;
            }
            
            .stat-icon {
                height: 50px;
                width: 50px;
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Toggle Button -->
    <button class="menu-toggle" id="menuToggle">
        <i data-feather="menu"></i>
    </button>

    <!-- Left Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-calendar-alt sidebar-brand-icon"></i>
            <h1>EventORG</h1>
        </div>
        
        <div class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i data-feather="home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('participant.dashboard') }}" class="nav-link {{ request()->routeIs('participant.dashboard') ? 'active' : '' }}">
                        <i data-feather="grid"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('participant.events') }}" class="nav-link {{ request()->routeIs('participant.events') ? 'active' : '' }}">
                        <i data-feather="calendar"></i> My Events
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('participant.tickets') }}" class="nav-link {{ request()->routeIs('participant.tickets') ? 'active' : '' }}">
                        <i data-feather="ticket"></i> My Tickets
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('events.index') }}" class="nav-link">
                        <i data-feather="search"></i> Browse Events
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">da</div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">dahhak</div>
                <div class="sidebar-user-role">Participant</div>
            </div>
            <div class="dropdown">
                <a class="sidebar-user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i data-feather="chevron-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile') }}"><i data-feather="user"></i> My Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('participant.tickets') }}"><i data-feather="ticket"></i> My Tickets</a></li>
                    <li><a class="dropdown-item" href="{{ route('participant.events') }}"><i data-feather="calendar"></i> My Events</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i data-feather="log-out"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="container py-4">
            <!-- Welcome Message -->
            <div class="welcome-section">
                <h2 class="welcome-heading">Welcome back, dahhak!</h2>
                <p class="welcome-subtext">Here's what's happening with your events today.</p>
            </div>
            
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-avatar-container">
                    <div class="profile-avatar">da</div>
                </div>
                <div class="profile-info">
                    <h2 class="profile-name">dahhak</h2>
                    <p class="profile-role">Participant</p>
                    <div class="events-badge">
                        <i data-feather="calendar"></i>
                        <span class="events-count">5 événements</span>
                    </div>
                </div>
                <div class="profile-actions">
                    <a href="{{ route('profile') }}" class="btn btn-edit-profile">
                        <i data-feather="edit"></i> Edit Profile
                    </a>
                </div>
            </div>
            
            <!-- Dashboard Title -->
            <h3 class="section-title">Mon Tableau de Bord</h3>
            
            <!-- Statistics Cards -->
            <div class="row g-4 mb-5">
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card stat-primary">
                        <div class="stat-card-inner">
                            <div class="stat-content">
                                <h6>Mes Événements</h6>
                                <h2 class="stat-value">5</h2>
                                <a href="{{ route('participant.events') }}" class="stat-link">
                                    Voir tous <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="stat-icon">
                                <i data-feather="calendar"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card stat-success">
                        <div class="stat-card-inner">
                            <div class="stat-content">
                                <h6>À Venir</h6>
                                <h2 class="stat-value">3</h2>
                                <span class="stat-info">Prochain dans 5 jours</span>
                            </div>
                            <div class="stat-icon">
                                <i data-feather="clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card stat-info">
                        <div class="stat-card-inner">
                            <div class="stat-content">
                                <h6>Billets</h6>
                                <h2 class="stat-value">5</h2>
                                <a href="{{ route('participant.tickets') }}" class="stat-link">
                                    Voir billets <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="stat-icon">
                                <i data-feather="ticket"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card stat-warning">
                        <div class="stat-card-inner">
                            <div class="stat-content">
                                <h6>Notifications</h6>
                                <h2 class="stat-value">0</h2>
                                <a href="#notifications" class="stat-link">
                                    Voir notifications <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="stat-icon">
                                <i data-feather="bell"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Content -->
            @yield('dashboard-content')
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('asset/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('asset/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('asset/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('asset/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('asset/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('asset/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('asset/js/main.js') }}"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Feather Icons
        feather.replace();
        
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        }
        
        // Animation for cards
        const cards = document.querySelectorAll('.stat-card, .event-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 + (index * 100));
        });
    });
    </script>
    
    @yield('scripts')
</body>
</html>