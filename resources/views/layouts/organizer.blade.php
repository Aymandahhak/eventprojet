<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'EventORG - Organizer Dashboard')</title>
    
    <!-- Favicon -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('asset/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    
    <!-- Additional Styles -->
    @yield('styles')

<style>
        /* Base Layout */
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #D1E0D7;
            color: #333;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Sidebar */
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
            display: flex;
            flex-direction: column;
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

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 1.5rem;
            min-height: 100vh;
            background: #D1E0D7;
            width: calc(100% - 250px);
        }

        /* Content Container */
        .content-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Mobile Menu Toggle */
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

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
    }
</style>
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Mobile Menu Toggle Button -->
    <button class="menu-toggle" id="menuToggle">
        <i data-feather="menu"></i>
    </button>

    <div class="container-fluid">
        <div class="row">
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
                            <a href="{{ route('organizer.dashboard') }}" class="nav-link {{ request()->routeIs('organizer.dashboard') ? 'active' : '' }}">
                                <i data-feather="grid"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('organizer.events') }}" class="nav-link {{ request()->routeIs('organizer.events') ? 'active' : '' }}">
                                <i data-feather="calendar"></i> Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('organizer.registrations.index') }}" class="nav-link {{ request()->routeIs('organizer.registrations.index') ? 'active' : '' }}">
                                <i class="fas fa-ticket-alt"></i> Registrations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('organizer.events.create') }}" class="nav-link bg-success mt-3">
                                <i data-feather="plus"></i> Create New Event
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="sidebar-user">
                    <div class="sidebar-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                        <div class="sidebar-user-role">Event Organizer</div>
                    </div>
                    <div class="dropdown">
                        <a class="sidebar-user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i data-feather="chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('organizer.profile') }}"><i data-feather="user"></i> My Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('organizer.events') }}"><i data-feather="calendar"></i> My Events</a></li>
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
                <div class="content-container">
                    @yield('dashboard-content')
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('asset/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('asset/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('asset/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('asset/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('asset/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('asset/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('asset/js/main.js') }}"></script>
    
    <!-- Additional Scripts -->
    @yield('scripts')
</body>
</html>