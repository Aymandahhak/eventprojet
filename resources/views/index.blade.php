<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>EventPro - Event Management Platform</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('asset/lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('asset/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('asset/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
        
        <!-- Custom colors and consolidated styles -->
        <style>
            /* Base & Color Styles */
            body {
                background-color: #D1E0D7;
            }
            
            .btn-primary, .bg-primary, .btn-primary:hover, .btn-primary:focus {
                background-color: #607EBC !important;
                border-color: #607EBC !important;
            }
            
            .btn-outline-primary {
                color: #607EBC !important;
                border-color: #607EBC !important;
            }
            
            .btn-outline-primary:hover {
                background-color: #607EBC !important;
                color: white !important;
            }
            
            .text-primary {
                color: #607EBC !important;
            }
            
            /* Attractions Styles */
            .attractions {
                position: relative;
                padding: 0;
                background: url('{{ asset('asset/img/env14.jpg') }}') center center no-repeat;
                background-size: cover;
                width: 100%;
                overflow: hidden;
            }
            
            .attractions:before {
                position: absolute;
                content: "";
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background: rgba(0, 0, 0, 0);
            }

            .attractions-section {
                position: relative;
                z-index: 1;
                width: 100%;
                padding: 60px 0;
            }
            
            /* Optimized Attractions Slider */
            .attraction-slider {
                position: relative;
                overflow: hidden;
                width: 100%;
                margin: 0 auto;
                padding: 0;
            }
            
            /* Clone the slider track to create continuous effect */
            .slider-track {
                display: flex;
                animation: scroll-left 60s linear infinite;
                width: fit-content;
                will-change: transform;
                transform: translate3d(0, 0, 0); /* Hardware acceleration */
            }
            
            .attraction-item {
                position: relative;
                height: 450px;
                width: 350px;
                margin-right: 20px;
                flex-shrink: 0;
                border-radius: 0;
                overflow: hidden;
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
            }
            
            .attraction-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.8s;
                will-change: transform;
            }
            
            .attraction-item:hover img {
                transform: scale(1.2);
            }
            
            .attraction-item .attractions-name {
                position: absolute;
                width: 100%;
                height: auto;
                left: 0;
                right: 0;
                bottom: 0;
                margin: 0;
                padding: 20px;
                text-align: center;
                background: rgba(0, 0, 0, 0.7);
                transition: all 0.5s;
                text-decoration: none;
                color: #FFFFFF;
                font-size: 22px;
                font-weight: 600;
                display: block;
            }
            
            .attraction-item:hover .attractions-name {
                background: rgba(0, 0, 0, 0.9);
            }
            
            /* Animation for continuous scrolling */
            @keyframes scroll-left {
                0% {
                    transform: translateX(0);
                }
                100% {
                    transform: translateX(calc(-350px * 6 - 20px * 6)); /* Width of items + gap, multiplied by number of items */
                }
            }
            
            /* Hide scrollbar */
            .attraction-slider::-webkit-scrollbar {
                display: none;
            }
            
            /* Pause animation on hover - uncomment if needed */
            /* 
            .attraction-slider:hover .slider-track {
                animation-play-state: paused;
            }
            */
            
            /* Remove existing carousel styles */
            /* Adjust the carousel container for full width */
            .owl-carousel.attractions-carousel {
                margin: 0 -15px;
                width: calc(100% + 30px);
            }
            
            /* Featured Items Styles */
            .featured-item {
                position: relative;
                overflow: hidden;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                margin: 10px;
                transition: all 0.3s ease;
            }
            
            .featured-item:hover {
                transform: translateY(-10px);
            }
            
            .featured-overlay {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(to top, rgba(96, 126, 188, 0.9), transparent);
                color: white;
                padding: 20px;
                transition: all 0.3s ease;
            }
            
            .featured-item:hover .featured-overlay {
                background: linear-gradient(to top, rgba(96, 126, 188, 1), rgba(96, 126, 188, 0.6));
                bottom: 0;
                top: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            
            .featured-overlay h4 {
                color: white;
                margin-bottom: 5px;
                font-weight: bold;
            }
            
            .featured-overlay p {
                color: white;
                margin-bottom: 0;
                opacity: 0;
                transition: all 0.3s ease;
            }
            
            .featured-item:hover .featured-overlay p {
                opacity: 1;
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

        <!-- Navbar & Hero Start -->
        <div class="container-fluid nav-bar sticky-top px-4 py-2 py-lg-0">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="#" class="navbar-brand p-0">
                    <h1 class="display-6 text-dark"><i class="fas fa-calendar-alt text-primary me-3"></i>EventORG</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                        <a href="#home" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="#services" class="nav-item nav-link">Services</a>
                        <a href="#" class="nav-item nav-link">events</a>
                        <a href="#contact" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="d-flex align-items-center">
                        <!-- Auth Links -->
                        @auth
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    @if(Auth::user()->isAdmin())
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.users') }}"><i class="fas fa-users me-2"></i>Users</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.events.index') }}"><i class="fas fa-calendar-alt me-2"></i>Events</a></li>
                                    @elseif(Auth::user()->isOrganizer())
                                        <li><a class="dropdown-item" href="{{ route('organizer.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{ route('organizer.events') }}"><i class="fas fa-calendar-alt me-2"></i>My Events</a></li>
                                        <li><a class="dropdown-item" href="{{ route('events.create') }}"><i class="fas fa-plus me-2"></i>Create Event</a></li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('participant.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{ route('participant.events') }}"><i class="fas fa-calendar-alt me-2"></i>My Events</a></li>
                                        <li><a class="dropdown-item" href="{{ route('participant.tickets') }}"><i class="fas fa-ticket-alt me-2"></i>My Tickets</a></li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Carousel Start -->
        <div id="home" class="header-carousel owl-carousel">
            <div class="header-carousel-item">
                <img src="{{ asset('asset/img/env2.jpg') }}" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="container align-items-center py-4">
                        <div class="row g-5 align-items-center">
                            <div class="col-xl-7 fadeInLeft animated" data-animation="fadeInLeft" data-delay="1s" style="animation-delay: 1s;">
                                <div class="text-start">
                                    <h4 class="text-primary text-uppercase fw-bold mb-4">Welcome To EventORG</h4>
                                    <h1 class="display-4 text-uppercase text-white mb-4">Discover and Manage Events with Ease</h1>
                                    <p class="mb-4 fs-5">Join thousands of professionals at top events. Find, register, and manage your events all in one place.
                                    </p>
                                    <div class="d-flex flex-shrink-0">
                                        <a class="btn btn-primary rounded-pill text-white py-3 px-5 me-3" href="#">Explore Events</a>
                                        <a class="btn btn-light rounded-pill text-primary py-3 px-5" href="#">Organize an Event</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item">
                <img src="{{ asset('asset/img/carousel-2.jpg') }}" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="container py-4">
                        <div class="row g-5 align-items-center">
                            <div class="col-xl-7 fadeInLeft animated" data-animation="fadeInLeft" data-delay="1s" style="animation-delay: 1s;">
                                <div class="text-start">
                                    <h4 class="text-primary text-uppercase fw-bold mb-4">Welcome To EventPro</h4>
                                    <h1 class="display-4 text-uppercase text-white mb-4">Create Unforgettable Events</h1>
                                    <p class="mb-4 fs-5">Plan, organize, and manage your events with ease. Our platform provides all the tools you need for successful event management.
                                    </p>
                                    <div class="d-flex flex-shrink-0">
                                        <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="#">Create Event</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fixed Search Form Overlay -->
        <div class="fixed-search-form">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-5">
                        <div class="ticket-form p-5">
                            <h2 class="text-dark text-uppercase mb-4">Search Events</h2>
                            <form action="{{ route('events.search') }}" method="GET">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="search-container">
                                            <input type="text" name="keyword" class="form-control border-0 py-2" placeholder="Search events by name, category, or date">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select name="type" class="form-select border-0 py-2" aria-label="Default select example">
                                            <option selected>Select Event Type</option>
                                            <option value="Conference">Conference</option>
                                            <option value="Workshop">Workshop</option>
                                            <option value="Seminar">Seminar</option>
                                            <option value="Networking">Networking</option>
                                            <option value="Training">Training</option>
                                            <option value="Exhibition">Exhibition</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <input name="date" class="form-control border-0 py-2" type="date" placeholder="Select Date">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100 py-2 px-5">Search Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->

        <!-- Categories Filter End -->

        <!-- Featured Events Start (Replacing Category Events) -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Featured Events</h4>
                    <h1 class="display-5 mb-4">Explore Our Top Events</h1>
                    <p class="mb-0">Discover our most popular events across various categories. From conferences to workshops, we have something for everyone. Don't miss these amazing opportunities to learn, network, and grow.</p>
                </div>
                
                <!-- Category Filter Carousel -->
                <div class="container-fluid attractions px-0">
                    <div class="attractions-section py-5">
                        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px; background-color: rgba(0,0,0,0.5); padding: 20px; border-radius: 15px; margin-bottom: 40px;">
                            <h4 class="text-primary">Event Categories</h4>
                            <h1 class="display-5 text-white mb-4">Explore Our Event Categories</h1>
                            <p class="text-white mb-0">Discover our wide range of event categories designed for professionals across all industries. From conferences to workshops, we offer events that help you learn, network, and grow your career.
                            </p>
                        </div>
                        
                        <!-- Replace owl carousel with optimized CSS animation -->
                        <div class="attraction-slider wow fadeInUp" data-wow-delay="0.1s">
                            <div class="slider-track">
                                <!-- Original set -->
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env1.jpg') }}" alt="Conference">
                                    <a href="{{ route('events.search', ['type' => 'Conference']) }}" class="attractions-name">
                                        <i class="fas fa-chalkboard-teacher me-2"></i>Conferences
                                    </a>
                                </div>
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env2.jpg') }}" alt="Workshop">
                                    <a href="{{ route('events.search', ['type' => 'Workshop']) }}" class="attractions-name">
                                        <i class="fas fa-laptop-code me-2"></i>Workshops
                                    </a>
                                </div>
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env3.jpg') }}" alt="Seminar">
                                    <a href="{{ route('events.search', ['type' => 'Seminar']) }}" class="attractions-name">
                                        <i class="fas fa-book-reader me-2"></i>Seminars
                                    </a>
                                </div>
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env4.jpg') }}" alt="Networking">
                                    <a href="{{ route('events.search', ['type' => 'Networking']) }}" class="attractions-name">
                                        <i class="fas fa-handshake me-2"></i>Networking
                                    </a>
                                </div>
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env5.jpg') }}" alt="Training">
                                    <a href="{{ route('events.search', ['type' => 'Training']) }}" class="attractions-name">
                                        <i class="fas fa-graduation-cap me-2"></i>Training
                                    </a>
                                </div>
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env9.jpg') }}" alt="Exhibition">
                                    <a href="{{ route('events.search', ['type' => 'Exhibition']) }}" class="attractions-name">
                                        <i class="fas fa-building me-2"></i>Exhibition
                                    </a>
                                </div>
                                
                                <!-- Clone set for continuous scrolling -->
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env1.jpg') }}" alt="Conference">
                                    <a href="{{ route('events.search', ['type' => 'Conference']) }}" class="attractions-name">
                                        <i class="fas fa-chalkboard-teacher me-2"></i>Conferences
                                    </a>
                                </div>
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env2.jpg') }}" alt="Workshop">
                                    <a href="{{ route('events.search', ['type' => 'Workshop']) }}" class="attractions-name">
                                        <i class="fas fa-laptop-code me-2"></i>Workshops
                                    </a>
                                </div>
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env3.jpg') }}" alt="Seminar">
                                    <a href="{{ route('events.search', ['type' => 'Seminar']) }}" class="attractions-name">
                                        <i class="fas fa-book-reader me-2"></i>Seminars
                                    </a>
                                </div>
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env4.jpg') }}" alt="Networking">
                                    <a href="{{ route('events.search', ['type' => 'Networking']) }}" class="attractions-name">
                                        <i class="fas fa-handshake me-2"></i>Networking
                                    </a>
                                </div>
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env5.jpg') }}" alt="Training">
                                    <a href="{{ route('events.search', ['type' => 'Training']) }}" class="attractions-name">
                                        <i class="fas fa-graduation-cap me-2"></i>Training
                                    </a>
                                </div>
                                <div class="attraction-item">
                                    <img src="{{ asset('asset/img/env9.jpg') }}" alt="Exhibition">
                                    <a href="{{ route('events.search', ['type' => 'Exhibition']) }}" class="attractions-name">
                                        <i class="fas fa-building me-2"></i>Exhibition
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Conference Events -->
                <div class="row mb-5">
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="text-primary"><i class="fas fa-chalkboard-teacher me-2"></i> Conferences</h3>
                            <a href="{{ route('events.search', ['type' => 'Conference']) }}" class="btn btn-outline-primary rounded-pill">View All <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                    
                    @php
                        $conferenceEvents = App\Models\Event::where('category', 'Conference')
                            ->where('is_published', true)
                            ->orderBy('start_date', 'asc')
                            ->take(3)
                            ->get();
                    @endphp
                    
                    @foreach($conferenceEvents as $event)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card h-100 event-card border-0 shadow-sm">
                            <div class="position-relative overflow-hidden">
                                @if($event->image)
                                    <img class="card-img-top" src="{{ asset('asset/img/' . $event->image) }}" alt="{{ $event->title }}">
                                @endif
                                <div class="position-absolute top-0 start-0 m-3">
                                    <div class="badge bg-primary rounded-pill px-3 py-2">{{ $event->category }}</div>
                                </div>
                                <div class="position-absolute top-0 end-0 m-3">
                                    <div class="badge bg-dark rounded-pill px-3 py-2">
                                        {{ $event->type }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title mb-3 text-truncate fw-bold">{{ $event->title }}</h5>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <small>{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</small>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="far fa-clock text-primary me-2"></i>
                                    <small>{{ \Carbon\Carbon::parse($event->start_date)->format('h:i A') }}</small>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <small class="text-truncate">{{ $event->location }}</small>
                                </div>
                                
                                <div class="mb-3 border-top pt-3">
                                    <p class="card-text mb-3" style="min-height: 60px;">
                                        {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                                    </p>
                                    
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <i class="fas fa-users text-primary me-1"></i>
                                            <small>{{ $event->registrations->count() }}/{{ $event->capacity }} participants</small>
                                        </div>
                                        <div>
                                            <small class="text-primary fw-bold">${{ number_format($event->price, 2) }}</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-info-circle me-2"></i>View Details
                                    </a>
                                    @auth
                                        @if(!$event->registrations()->where('user_id', auth()->id())->exists())
                                            <form action="{{ route('registrations.store', $event) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="ticket_quantity" value="1">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="fas fa-ticket-alt me-2"></i>Book Now
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-success w-100" disabled>
                                                <i class="fas fa-check-circle me-2"></i>Already Booked
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary">
                                            <i class="fas fa-ticket-alt me-2"></i>Book Now
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Workshop Events -->
                <div class="row mb-5">
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="text-primary"><i class="fas fa-laptop-code me-2"></i> Workshops</h3>
                            <a href="{{ route('events.search', ['type' => 'Workshop']) }}" class="btn btn-outline-primary rounded-pill">View All <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                    
                    @php
                        $workshopEvents = App\Models\Event::where('category', 'Workshop')
                            ->where('is_published', true)
                            ->orderBy('start_date', 'asc')
                            ->take(3)
                            ->get();
                    @endphp
                    
                    @foreach($workshopEvents as $event)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card h-100 event-card border-0 shadow-sm">
                            <div class="position-relative overflow-hidden">
                                @if($event->image)
                                    <img class="card-img-top" src="{{ asset('asset/img/' . $event->image) }}" alt="{{ $event->title }}">
                                @endif
                                <div class="position-absolute top-0 start-0 m-3">
                                    <div class="badge bg-primary rounded-pill px-3 py-2">{{ $event->category }}</div>
                                </div>
                                <div class="position-absolute top-0 end-0 m-3">
                                    <div class="badge bg-dark rounded-pill px-3 py-2">
                                        {{ $event->type }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title mb-3 text-truncate fw-bold">{{ $event->title }}</h5>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <small>{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</small>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="far fa-clock text-primary me-2"></i>
                                    <small>{{ \Carbon\Carbon::parse($event->start_date)->format('h:i A') }}</small>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <small class="text-truncate">{{ $event->location }}</small>
                                </div>
                                
                                <div class="mb-3 border-top pt-3">
                                    <p class="card-text mb-3" style="min-height: 60px;">
                                        {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                                    </p>
                                    
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <i class="fas fa-users text-primary me-1"></i>
                                            <small>{{ $event->registrations->count() }}/{{ $event->capacity }} participants</small>
                                        </div>
                                        <div>
                                            <small class="text-primary fw-bold">${{ number_format($event->price, 2) }}</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-info-circle me-2"></i>View Details
                                    </a>
                                    @auth
                                        @if(!$event->registrations()->where('user_id', auth()->id())->exists())
                                            <form action="{{ route('registrations.store', $event) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="ticket_quantity" value="1">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="fas fa-ticket-alt me-2"></i>Book Now
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-success w-100" disabled>
                                                <i class="fas fa-check-circle me-2"></i>Already Booked
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary">
                                            <i class="fas fa-ticket-alt me-2"></i>Book Now
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Other Category Events -->
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="text-primary"><i class="fas fa-star me-2"></i> Other Events</h3>
                            <a href="{{ route('events.index') }}" class="btn btn-outline-primary rounded-pill">View All Events <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                    
                    @php
                        $otherEvents = App\Models\Event::whereNotIn('category', ['Conference', 'Workshop'])
                            ->where('is_published', true)
                            ->orderBy('start_date', 'asc')
                            ->take(3)
                            ->get();
                    @endphp
                    
                    @foreach($otherEvents as $event)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card h-100 event-card border-0 shadow-sm">
                            <div class="position-relative overflow-hidden">
                                @if($event->image)
                                    <img class="card-img-top" src="{{ asset('asset/img/' . $event->image) }}" alt="{{ $event->title }}">
                                @endif
                                <div class="position-absolute top-0 start-0 m-3">
                                    <div class="badge bg-primary rounded-pill px-3 py-2">{{ $event->category }}</div>
                                </div>
                                <div class="position-absolute top-0 end-0 m-3">
                                    <div class="badge bg-dark rounded-pill px-3 py-2">
                                        {{ $event->type }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title mb-3 text-truncate fw-bold">{{ $event->title }}</h5>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <small>{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</small>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="far fa-clock text-primary me-2"></i>
                                    <small>{{ \Carbon\Carbon::parse($event->start_date)->format('h:i A') }}</small>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <small class="text-truncate">{{ $event->location }}</small>
                                </div>
                                
                                <div class="mb-3 border-top pt-3">
                                    <p class="card-text mb-3" style="min-height: 60px;">
                                        {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                                    </p>
                                    
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <i class="fas fa-users text-primary me-1"></i>
                                            <small>{{ $event->registrations->count() }}/{{ $event->capacity }} participants</small>
                                        </div>
                                        <div>
                                            <small class="text-primary fw-bold">${{ number_format($event->price, 2) }}</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-info-circle me-2"></i>View Details
                                    </a>
                                    @auth
                                        @if(!$event->registrations()->where('user_id', auth()->id())->exists())
                                            <form action="{{ route('registrations.store', $event) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="ticket_quantity" value="1">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="fas fa-ticket-alt me-2"></i>Book Now
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-success w-100" disabled>
                                                <i class="fas fa-check-circle me-2"></i>Already Booked
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary">
                                            <i class="fas fa-ticket-alt me-2"></i>Book Now
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Featured Events End -->

        <!-- How It Works Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">How It Works</h4>
                    <h1 class="display-5 mb-4">Simple Steps to Get Started</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item p-4 text-center">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-search fa-4x text-primary"></i>
                                </div>
                                <h4 class="mb-3">Find Events</h4>
                                <p class="mb-0">Browse through our extensive collection of events and find the perfect match for you.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item p-4 text-center">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-ticket-alt fa-4x text-primary"></i>
                                </div>
                                <h4 class="mb-3">Register in Seconds</h4>
                                <p class="mb-0">Quick and easy registration process to secure your spot at any event.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item p-4 text-center">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-calendar-check fa-4x text-primary"></i>
                                </div>
                                <h4 class="mb-3">Manage Your Events</h4>
                                <p class="mb-0">Keep track of your registered events and manage your schedule efficiently.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="service-item p-4 text-center">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-chart-line fa-4x text-primary"></i>
                                </div>
                                <h4 class="mb-3">Track Attendance</h4>
                                <p class="mb-0">Monitor your event participation and access your event history anytime.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- How It Works End -->

        <!-- Feature Start -->
        
        <!-- Feature End -->

        <!-- About Start -->
        <div id="about" class="container-fluid about pb-5">
            <div class="container pb-5">
                <div class="row g-5">
                    <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div>
                            <h4 class="text-primary">About EventPro</h4>
                            <h1 class="display-5 mb-4">Your Complete Event Management Solution</h1>
                            <p class="mb-5">EventPro is a comprehensive event management platform designed to streamline the entire event planning process. From small workshops to large conferences, we provide all the tools you need for successful event organization.
                            </p>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="me-3"><i class="fas fa-calendar-check fa-3x text-primary"></i></div>
                                        <div>
                                            <h4>Easy Scheduling</h4>
                                            <p>Intuitive calendar and scheduling tools for seamless event planning.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="me-3"><i class="fas fa-ticket-alt fa-3x text-primary"></i></div>
                                        <div>
                                            <h4>Ticket Management</h4>
                                            <p>Efficient ticket sales and registration management system.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="me-3"><i class="fas fa-chart-line fa-3x text-primary"></i></div>
                                        <div>
                                            <h4>Analytics</h4>
                                            <p>Comprehensive analytics and reporting tools for event insights.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="me-3"><i class="fas fa-bullhorn fa-3x text-primary"></i></div>
                                        <div>
                                            <h4>Marketing Tools</h4>
                                            <p>Integrated marketing and promotion features for your events.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="position-relative rounded">
                            <div class="rounded" style="margin-top: 40px;">
                                <div class="row g-0">
                                    <div class="col-lg-12">
                                        <div class="rounded mb-4">
                                            <img src="{{ asset('asset/img/about.jpg') }}" class="img-fluid rounded w-100" alt="">
                                        </div>
                                        <div class="row gx-4 gy-0">
                                            <div class="col-6">
                                                <div class="counter-item bg-primary rounded text-center p-4 h-100">
                                                    <div class="counter-item-icon mx-auto mb-3">
                                                        <i class="fas fa-users fa-3x text-white"></i>
                                                    </div>
                                                    <div class="counter-counting mb-3">
                                                        <span class="text-white fs-2 fw-bold" data-toggle="counter-up">150</span>
                                                        <span class="h1 fw-bold text-white">K +</span>
                                                    </div>
                                                    <h5 class="text-white mb-0">Happy Users</h5>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="counter-item bg-dark rounded text-center p-4 h-100">
                                                    <div class="counter-item-icon mx-auto mb-3">
                                                        <i class="fas fa-calendar-alt fa-3x text-white"></i>
                                                    </div>
                                                    <div class="counter-counting mb-3">
                                                        <span class="text-white fs-2 fw-bold" data-toggle="counter-up">122</span>
                                                        <span class="h1 fw-bold text-white"> +</span>
                                                    </div>
                                                    <h5 class="text-white mb-0">Events Managed</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded bg-primary p-4 position-absolute d-flex justify-content-center" style="width: 90%; height: 80px; top: -40px; left: 50%; transform: translateX(-50%);">
                                <h3 class="mb-0 text-white">5 Years Experience</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Service Start -->
        <div id="services" class="container-fluid service py-5">
            <div class="container service-section py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Services</h4>
                    <h1 class="display-5 text-white mb-4">Comprehensive Event Management Solutions</h1>
                    <p class="mb-0 text-white">From event planning to execution, we provide end-to-end solutions for all your event management needs. Our platform offers powerful tools and features to make your events successful.
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-0 col-md-1 col-lg-2 col-xl-2"></div>
                    <div class="col-md-10 col-lg-8 col-xl-8 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-days p-4">
                            <div class="py-2 border-bottom border-top d-flex align-items-center justify-content-between flex-wrap"><h4 class="mb-0 pb-2 pb-sm-0">Monday - Friday</h4> <p class="mb-0"><i class="fas fa-clock text-primary me-2"></i>9:00 AM - 6:00 PM</p></div>
                            <div class="py-2 border-bottom d-flex align-items-center justify-content-between flex-shrink-1 flex-wrap"><h4 class="mb-0 pb-2 pb-sm-0">Saturday - Sunday</h4> <p class="mb-0"><i class="fas fa-clock text-primary me-2"></i>10:00 AM - 4:00 PM</p></div>
                            <div class="py-2 border-bottom d-flex align-items-center justify-content-between flex-shrink-1 flex-wrap"><h4 class="mb-0">Support Hours</h4> <p class="mb-0"><i class="fas fa-clock text-primary me-2"></i>24/7 Online Support</p></div>
                        </div>
                    </div>
                    <div class="col-0 col-md-1 col-lg-2 col-xl-2"></div>

                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item p-4">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-calendar-plus fa-4x"></i>
                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">Event Planning</a>
                                <p class="mb-0">Comprehensive tools for planning and organizing successful events.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item p-4">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-ticket-alt fa-4x"></i>
                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">Ticket Management</a>
                                <p class="mb-0">Efficient ticket sales and registration management system.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item p-4">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-bullhorn fa-4x"></i>
                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">Event Marketing</a>
                                <p class="mb-0">Powerful marketing tools to promote your events effectively.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="service-item p-4">
                            <div class="service-content">
                                <div class="mb-4">
                                    <i class="fas fa-chart-line fa-4x"></i>
                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">Analytics</a>
                                <p class="mb-0">Detailed analytics and reporting for event performance.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        <!-- Ticket Packages Start -->
       
        <!-- Ticket Packages End -->

        <!-- Contact Start -->
        <div id="contact" class="container-fluid py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Contact Us</h4>
                    <h1 class="display-5 mb-4">Get In Touch For Any Query</h1>
                    <p class="mb-0">Have questions about our event management platform? Need help planning your next event? Contact us today and our team will be happy to assist you with any inquiries.</p>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 rounded">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-map-marker-alt text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Our Office</h5>
                                        <p class="mb-0">123 Event Street, City, Country</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 rounded">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-phone text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Call Us</h5>
                                        <p class="mb-0">+012 345 6789</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 rounded">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-envelope text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Email Us</h5>
                                        <p class="mb-0">info@eventpro.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 rounded">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-clock text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Office Hours</h5>
                                        <p class="mb-0">Mon-Fri: 9am-6pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="mb-4">Our dedicated support team is ready to assist you with any questions or concerns about our event management platform. We're committed to helping you create successful and memorable events.</p>
                        <div class="d-flex align-items-center">
                            <a class="btn btn-primary rounded-circle me-3" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary rounded-circle me-3" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary rounded-circle me-3" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-primary rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.4s">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->

        <!-- Footer Start -->
        <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-4 col-md-6">
                        <h4 class="text-white mb-4">About EventORG</h4>
                        <p class="mb-4">Your premier platform for discovering, managing, and organizing events. Join our community of professionals and make your events a success.</p>
                        <div class="d-flex pt-3">
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h4 class="text-white mb-4">Quick Links</h4>
                        <div class="d-flex flex-column">
                            <a class="text-white mb-2" href="#"><i class="fas fa-angle-right me-2"></i>About Us</a>
                            <a class="text-white mb-2" href="#"><i class="fas fa-angle-right me-2"></i>Contact Us</a>
                            <a class="text-white mb-2" href="#"><i class="fas fa-angle-right me-2"></i>Our Services</a>
                            <a class="text-white mb-2" href="#"><i class="fas fa-angle-right me-2"></i>Terms & Conditions</a>
                            <a class="text-white" href="#"><i class="fas fa-angle-right me-2"></i>Privacy Policy</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h4 class="text-white mb-4">Contact Info</h4>
                        <p class="mb-2"><i class="fas fa-map-marker-alt me-3"></i>123 Event Street, City, Country</p>
                        <p class="mb-2"><i class="fas fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fas fa-envelope me-3"></i>info@eventorg.com</p>
                        <div class="d-flex pt-3">
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-square btn-light rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>EventORG</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <span class="text-light">Designed By <a href="#" class="text-light">EventORG Team</a></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

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
        
        <!-- Consolidated JavaScript -->
        <script>
            $(document).ready(function(){
                // Add smooth scrolling to all links
                $("a").on('click', function(event) {
                    // Make sure this.hash has a value before overriding default behavior
                    if (this.hash !== "") {
                        // Prevent default anchor click behavior
                        event.preventDefault();
                        
                        // Store hash
                        var hash = this.hash;
                        
                        // Using jQuery's animate() method to add smooth page scroll
                        $('html, body').animate({
                            scrollTop: $(hash).offset().top
                        }, 800, function(){
                            // Add hash (#) to URL when done scrolling (default click behavior)
                            window.location.hash = hash;
                        });
                    }
                });

                // Prevent carousel from advancing when interacting with fixed search form
                $('.fixed-search-form input, .fixed-search-form select, .fixed-search-form button').on('click focus keydown', function(e) {
                    e.stopPropagation();
                });

                // Initialize carousel
                $('.header-carousel').owlCarousel({
                    autoplay: true,
                    smartSpeed: 1500,
                    items: 1,
                    dots: true,
                    loop: true,
                    nav: true,
                    navText: [
                        '<i class="fas fa-angle-left"></i>',
                        '<i class="fas fa-angle-right"></i>'
                    ]
                });
                
                // Initialize featured carousel
                $(".featured-carousel").owlCarousel({
                    autoplay: true,
                    smartSpeed: 2000,
                    center: false,
                    dots: true,
                    loop: true,
                    margin: 25,
                    nav : true,
                    navText : [
                        '<i class="fa fa-angle-left"></i>',
                        '<i class="fa fa-angle-right"></i>'
                    ],
                    responsiveClass: true,
                    responsive: {
                        0:{
                            items:1
                        },
                        576:{
                            items:2
                        },
                        768:{
                            items:3
                        },
                        992:{
                            items:4
                        }
                    }
                });
            });
        </script>
    </body>
</html>