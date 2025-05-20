<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Eventify - The Ultimate Platform for Planning and Promoting Successful Events</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
            :root {
                --primary-dark: #070a13;
                --primary-medium: #101624;
                --accent-start: #3a3456;
                --accent-end: #23243a;
                --accent-end-rgb: 35, 36, 58;
                --text-white: #f8f9fa;
                --text-light: #cfd2da;
                --text-muted: #7a7d8a;
                --card-bg: rgba(16, 22, 36, 0.7);
                --border-color: rgba(255, 255, 255, 0.07);
                --footer-bg: var(--primary-dark);
                --copyright-bg: #070b17;
            }
            
            body {
                background: var(--primary-dark);
                color: var(--text-light);
                font-family: 'Montserrat', sans-serif;
                min-height: 100vh;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
            
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Montserrat', sans-serif;
                font-weight: 700; /* Bold titles */
                color: var(--text-white);
            }

            h1.display-4, h1.display-5 {
                font-weight: 800; /* Even bolder for main titles */
                letter-spacing: -0.5px;
            }
            
            p {
                font-family: 'Open Sans', sans-serif; /* Readable body font */
                color: var(--text-light);
                line-height: 1.8; /* Improved readability */
                font-size: 1rem;
            }

            .text-muted {
                color: var(--text-muted) !important;
            }
            
            /* Fix for button styling */
            .btn {
                position: relative;
                border-radius: 50px;
                padding: 10px 25px;
                font-weight: 600;
                letter-spacing: 0.5px;
                transition: all 0.3s ease;
                border: none;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                text-decoration: none;
                display: inline-block;
            }
            
            /* Ensure text is visible in buttons */
            .btn span {
                position: relative;
                z-index: 2;
                color: var(--text-white);
            }
            
            .button-inner-static,
            .button-inner-hover {
                width: 100%;
                text-align: center;
                font-weight: 600;
            }
            
            /* Make navbar links white */
            .navbar-light .navbar-nav .nav-link {
                color: var(--text-white) !important;
            }
            
            .navbar-light .navbar-nav .nav-link:hover,
            .navbar-light .navbar-nav .nav-link.active {
                color: var(--text-white) !important;
            }
            
            /* Remove after pseudo-element that darkens carousel images */
            .header-carousel-item::after {
                display: none !important;
                content: none !important;
            }
            
            /* Fix carousel item styling */
            .header-carousel-item {
                position: relative;
                height: 100vh;
                min-height: 600px;
                width: 100%;
                background-position: center;
                background-size: cover;
            }
            
            /* Fix carousel caption */
            .carousel-caption {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                background: rgba(10, 15, 31, 0.5);
                background: linear-gradient(to right, rgba(10, 15, 31, 0.8) 0%, rgba(10, 15, 31, 0.4) 100%);
                z-index: 1;
            }
            
            /* Fix the search form inside the carousel */
            .fixed-search-form-inner {
                padding: 20px;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            /* Ticket form inside the carousel */
            .ticket-form {
                background-color: rgba(28, 22, 60, 0.85) !important;
                border-radius: 15px;
                backdrop-filter: blur(10px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                padding: 25px !important;
                width: 100%;
            }
            
            /* For the carousel buttons */
            #home .btn {
                height: auto !important;
                padding: 10px 30px !important;
                display: inline-block !important;
            }
            
            /* Special fix for auth buttons */
            .nav-bar .btn {
                display: inline-block !important;
                min-width: 90px;
            }
            
            /* Custom button styling for clear display */
            .button {
                position: relative;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 10px 25px;
            }
            
            /* Add these to ensure login/register buttons show properly */
            .button-bg-layers {
                z-index: 1 !important;
            }
            
            .button-bg {
                z-index: 1 !important;
            }
            
            /* Text elements must be above button bg */
            .button-inner-static, 
            .button-inner-hover {
                z-index: 2 !important;
                position: relative !important;
                color: white !important;
            }

            /* Custom Button Styles from Uiverse.io by OliverZeros */
            button {
              all: unset;
            }

            .button {
              position: relative;
              display: inline-flex;
              height: 3.5rem;
              align-items: center;
              border-radius: 9999px;
              padding-left: 2rem;
              padding-right: 2rem;
              font-family: Segoe UI;
              font-size: 1.2rem;
              font-weight: 640;
              color: #fafaf6;
              letter-spacing: -0.06em;
            }

            /* New class for View Details button and similar buttons */
            .consistent-btn-view {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 10px 15px;
                background: transparent;
                color: #FFD074 !important;
                font-weight: 600;
                border-radius: 50px;
                text-decoration: none;
                border: 1px solid #FFD074;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                white-space: nowrap;
                min-height: 40px;
                line-height: 1.25rem;
            }

            .consistent-btn-view:hover {
                background: rgba(255, 208, 116, 0.1);
                color: #FAECC5 !important;
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            }

            .consistent-btn-view i {
                margin-right: 8px;
            }

            .button-item {
              background-color: transparent;
              color: #1d1d1f;
            }

            .button-item .button-bg {
              border-color: rgba(255, 208, 116);
              background-color: rgba(255, 208, 116);
            }

            .button-inner,
            .button-inner-hover,
            .button-inner-static {
              pointer-events: none;
              display: block;
            }

            .button-inner {
              position: relative;
            }

            .button-inner-hover {
              position: absolute;
              top: 0;
              left: 0;
              opacity: 0;
              transform: translateY(70%);
            }

            .button-bg {
              overflow: hidden;
              border-radius: 2rem;
              position: absolute;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              transform: scale(1);
              transition: transform 1.8s cubic-bezier(0.19, 1, 0.22, 1);
            }

            .button-bg,
            .button-bg-layer,
            .button-bg-layers {
              display: block;
            }

            .button-bg-layers {
              position: absolute;
              left: 50%;
              transform: translate(-50%);
              top: -60%;
              aspect-ratio: 1 / 1;
              width: max(200%, 10rem);
            }

            .button-bg-layer {
              border-radius: 9999px;
              position: absolute;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              transform: scale(0);
            }

            .button-bg-layer.-purple {
              background-color: rgba(163, 116, 255);
            }

            .button-bg-layer.-turquoise {
              background-color: rgba(23, 241, 209);
            }

            .button-bg-layer.-yellow {
              --tw-bg-opacity: 1;
              background-color: rgba(255, 208, 116, var(--tw-bg-opacity));
            }

            .button:hover .button-inner-static {
              opacity: 0;
              transform: translateY(-70%);
              transition:
                transform 1.4s cubic-bezier(0.19, 1, 0.22, 1),
                opacity 0.3s linear;
            }

            .button:hover .button-inner-hover {
              opacity: 1;
              transform: translateY(0);
              transition:
                transform 1.4s cubic-bezier(0.19, 1, 0.22, 1),
                opacity 1.4s cubic-bezier(0.19, 1, 0.22, 1);
            }

            .button:hover .button-bg-layer {
              transition:
                transform 1.3s cubic-bezier(0.19, 1, 0.22, 1),
                opacity 0.3s linear;
            }

            .button:hover .button-bg-layer-1 {
              transform: scale(1);
            }

            .button:hover .button-bg-layer-2 {
              transition-delay: 0.1s;
              transform: scale(1);
            }

            .button:hover .button-bg-layer-3 {
              transition-delay: 0.2s;
              transform: scale(1);
            }
            
            /* Navigation Styles */
            .nav-bar {
                background-color: rgba(10, 15, 31, 0.7); /* Darker, more transparent */
                backdrop-filter: blur(10px);
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }
            
            .navbar-brand .logo-icon {
                width: 35px;
                height: 35px;
                background: linear-gradient(135deg, var(--accent-start), var(--accent-end));
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: bold;
                font-size: 18px; /* E */
                margin-right: 8px;
                box-shadow: 0 2px 8px rgba(192, 108, 132, 0.3);
            }
            
            .navbar-light .navbar-brand h1 {
                color: var(--text-white);
                font-weight: 700;
                font-size: 1.75rem; /* Brand name size */
                display: inline-flex;
                align-items: center;
            }
            
            .text-dark { /* Redefine for dark theme */
                color: var(--text-white) !important;
            }

            .fa-search {
                color: var(--text-light);
                transition: color 0.3s ease;
            }
            .fa-search:hover {
                color: var(--accent-start);
            }

            /* Contact Button in Navbar */
            .contact-btn {
                background: linear-gradient(90deg, var(--accent-start) 0%, var(--accent-end) 100%);
                color: var(--text-white) !important;
                border-radius: 50px;
                padding: 8px 20px;
                font-weight: 600;
                letter-spacing: 0.5px;
                transition: all 0.3s ease;
                border: none;
                box-shadow: 0 4px 15px rgba(192, 108, 132, 0.3);
            }

            .contact-btn:hover {
                background: linear-gradient(90deg, var(--accent-hover-start) 0%, var(--accent-hover-end) 100%);
                transform: translateY(-2px) scale(1.05);
                box-shadow: 0 6px 20px rgba(192, 108, 132, 0.4);
            }
            
            /* Card & Content Styles */
            .bg-light { /* Will be used for cards and sections */
                background-color: var(--card-bg) !important; 
                backdrop-filter: blur(5px);
                border: 1px solid var(--border-color);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
                border-radius: 15px; /* Rounded cards */
            }
            
            .card, .event-card, .service-item, .counter-item, .ticket-form, .service-days {
                background: var(--card-bg);
                border: 1px solid var(--border-color);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease;
                backdrop-filter: blur(5px);
                overflow: hidden;
                border-radius: 15px; /* Consistent rounded corners */
            }
            
            .card:hover, .event-card:hover, .service-item:hover {
                transform: translateY(-8px) scale(1.03); /* Increased lift and added scale */
                box-shadow: 0 15px 35px rgba(var(--accent-end-rgb), 0.25); /* Shadow using accent color, reduced opacity slightly */
                border-color: var(--accent-end); /* Brighter accent border on hover */
            }
            
            .form-control, .form-select {
                background-color: rgba(255, 255, 255, 0.05); /* Slightly lighter input bg */
                color: var(--text-light);
                border: 1px solid var(--border-color);
                backdrop-filter: blur(5px);
                transition: all 0.3s ease;
                border-radius: 10px; /* Rounded inputs */
                padding: 12px 15px;
            }
            
            .form-control:focus, .form-select:focus {
                background-color: rgba(255, 255, 255, 0.1);
                border-color: var(--accent-start);
                box-shadow: 0 0 0 3px rgba(108, 91, 123, 0.3); /* Accent glow on focus */
                color: var(--text-white);
            }
            
            .form-control::placeholder {
                color: var(--text-muted);
            }
            .form-floating > label {
                color: var(--text-muted);
            }
            
            /* Attractions Styles (Image Carousel) */
            .attractions {
                position: relative;
                padding: 0;
                /* background image is set inline */
                background-size: cover;
                width: 100%;
                overflow: hidden;
            }
            
            .attractions:before { /* Gradient overlay for the attractions section */
                position: absolute;
                content: "";
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background: linear-gradient(135deg, rgba(10, 15, 31, 0.85), rgba(28, 22, 60, 0.75));
            }

            .attractions-section { /* Content within attractions */
                position: relative;
                z-index: 1;
                width: 100%;
                padding: 80px 0; /* More padding */
            }
            
            /* Optimized Attractions Slider */
            .attraction-slider {
                position: relative;
                overflow: hidden;
                width: 100%;
                margin: 0 auto;
                padding: 0;
            }
            
            .slider-track {
                display: flex;
                animation: scroll-left 60s linear infinite;
                width: fit-content;
                will-change: transform;
            }
            
            .attraction-item {
                position: relative;
                height: 400px; /* Adjusted height */
                width: 320px;  /* Adjusted width */
                margin-right: 25px; /* Adjusted gap */
                flex-shrink: 0;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
                transition: all 0.3s ease;
            }

            .attraction-item:hover {
                 transform: translateY(-5px) scale(1.03);
                 box-shadow: 0 15px 30px rgba(0,0,0,0.4);
            }
            
            .attraction-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.8s ease;
            }
            
            .attraction-item:hover img {
                transform: scale(1.15); /* Slightly more zoom */
            }
            
            .attraction-item .attractions-name {
                position: absolute;
                width: 100%;
                left: 0;
                right: 0;
                bottom: 0;
                margin: 0;
                padding: 25px 20px; /* More padding */
                text-align: center;
                background: linear-gradient(0deg, rgba(10, 15, 31, 0.95) 0%, transparent 100%);
                transition: all 0.5s ease;
                text-decoration: none;
                color: var(--text-white);
                font-size: 1.25rem; /* Slightly larger text */
                font-weight: 600;
            }
            
            .attraction-item:hover .attractions-name {
                background: linear-gradient(0deg, rgba(108, 91, 123, 0.9) 0%, transparent 100%);
                padding-bottom: 30px; /* Lift text slightly more */
            }
            
            @keyframes scroll-left {
                0% { transform: translateX(0); }
                100% { transform: translateX(calc(-320px * 6 - 25px * 6)); } /* Adjusted for new item width and gap */
            }
            
            .attraction-slider::-webkit-scrollbar { display: none; }
            
            /* Featured Items (Event Cards in current code) */
            /* Styles for .event-card are already covered by .card above */
            
            .footer, .service { /* .service is a section in current code */
                background: var(--footer-bg); /* Solid dark for footer sections */
                padding-top: 60px;
                padding-bottom: 0; /* Copyright has its own padding */
            }

            .footer h4 {
                margin-bottom: 25px;
                color: var(--text-white);
            }

            .footer p, .footer a {
                color: var(--text-muted);
                transition: color 0.3s ease;
            }
            .footer a:hover {
                color: var(--accent-start);
            }

            .copyright {
                background-color: var(--copyright-bg); /* Even darker for copyright */
                border-top: 1px solid var(--border-color);
                padding: 25px 0;
                font-size: 0.9rem;
            }
            .copyright a {
                 color: var(--accent-start);
                 font-weight: 500;
            }
            .copyright a:hover {
                color: var(--accent-end);
            }


            /* Hero Carousel Specifics */
            .header-carousel-item {
                position: relative;
                height: 90vh; /* Adjust height for hero section */
                min-height: 600px;
                display: flex;
                align-items: center;
            }
            
            .header-carousel-item img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: 0;
            }

            .header-carousel-item::after { /* Darkening overlay for hero images */
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: transparent; /* Removed dark gradient overlay */
                z-index: 1;
            }
            
            .carousel-caption { /* Content over the hero image */
                position: relative;
                z-index: 2;
                background: none; /* Remove previous background */
                backdrop-filter: none;
                text-align: center; /* Center text instead of left align */
                max-width: 100%; /* Full width */
                margin: 0 auto; /* Center the content */
            }
            .carousel-caption .container {
                padding: 0 30px; /* Add some padding from edge */
            }

            .carousel-caption h4 { /* "Welcome to Eventify" */
                color: var(--accent-start) !important;
                font-weight: 600;
                letter-spacing: 1px;
            }
            .carousel-caption h1 { /* Main hero title */
                font-size: 3rem; /* Larger hero title */
                font-weight: 800;
                line-height: 1.2;
                margin-bottom: 20px !important;
            }
             .carousel-caption p {
                font-size: 1.1rem;
                margin-bottom: 30px !important;
                max-width: 800px; /* Wider content */
                margin-left: auto; /* Center paragraph */
                margin-right: auto;
                color: var(--text-light);
            }

            /* Fixed Search Form Overlay - making it match the dark theme */
            .fixed-search-form {
                 /* position fixed is handled by existing styles if this is a popup */
            }
            .ticket-form { /* This class is used for the search form */
                background: var(--card-bg) !important; /* Ensure dark background for search form card */
                padding: 30px; /* More padding */
                /* border-radius, shadow already handled by .card style */
            }
            .ticket-form h2 {
                margin-bottom: 25px;
                font-size: 1.75rem;
            }

            /* "Who We Are" and "Benefits" sections */
            .about, .service { /* Assuming these are container classes for those sections */
                padding-top: 80px;
                padding-bottom: 80px;
            }

            .section-title-container { /* For titles like "WHO WE ARE" */
                margin-bottom: 40px;
            }
            .section-title-container h1, .section-title-container h4 {
                text-align: center;
            }
            .section-title-container h4 {
                color: var(--accent-start) !important;
                font-weight: 600;
                letter-spacing: 1px;
                margin-bottom: 10px;
            }
            .section-title-container h1 {
                font-size: 2.5rem;
                margin-bottom: 15px;
            }
             .section-title-container p { /* For introductory text under section titles */
                max-width: 700px;
                margin-left: auto;
                margin-right: auto;
                color: var(--text-muted);
            }

            /* Benefits boxes (Global, Advanced, etc.) */
            .benefit-item { /* Assuming a new class for these boxes */
                text-align: center;
                padding: 30px 20px;
                background: rgba(255, 255, 255, 0.03); /* Very subtle background */
                border: 1px solid var(--border-color);
                border-radius: 10px;
                transition: all 0.3s ease;
                height: 100%;
            }
            .benefit-item:hover {
                background: rgba(108, 91, 123, 0.2); /* Accent color on hover */
                border-color: var(--accent-start);
                transform: translateY(-5px);
            }
            .benefit-item .icon {
                font-size: 2.5rem;
                color: var(--accent-start);
                margin-bottom: 20px;
                display: inline-block;
                line-height: 1;
            }
             .benefit-item h5 {
                font-size: 1.1rem;
                font-weight: 600;
                color: var(--text-white);
                margin-bottom: 10px;
            }
            .benefit-item p {
                font-size: 0.9rem;
                color: var(--text-muted);
            }

            /* Social Media Icons - Footer and potentially hero */
            .social-icons a {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.05);
                color: var(--text-light);
                border: 1px solid var(--border-color);
                margin-right: 10px;
                transition: all 0.3s ease;
            }
            .social-icons a:hover {
                background: linear-gradient(90deg, var(--accent-start) 0%, var(--accent-end) 100%);
                color: var(--text-white);
                transform: translateY(-3px);
                border-color: transparent;
            }
            
            /* Back to Top Button */
            .back-to-top {
                background: linear-gradient(135deg, var(--accent-start), var(--accent-end));
                color: var(--text-white);
                box-shadow: 0 4px 15px rgba(192, 108, 132, 0.4);
            }
            .back-to-top:hover {
                transform: scale(1.1);
                 box-shadow: 0 6px 20px rgba(192, 108, 132, 0.5);
            }

            /* Spinner */
            .spinner-border {
                color: var(--accent-start); /* Use accent color */
                border-right-color: transparent !important; /* For the spinning effect */
            }

            /* Ensure Owl Carousel Nav buttons fit the dark theme */
            .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev {
                background: rgba(255, 255, 255, 0.1) !important;
                color: var(--text-white) !important;
                border-radius: 50% !important;
                width: 40px;
                height: 40px;
                font-size: 1.2rem !important;
                transition: all 0.3s ease !important;
            }
            .owl-carousel .owl-nav button.owl-next:hover, .owl-carousel .owl-nav button.owl-prev:hover {
                background: linear-gradient(90deg, var(--accent-start) 0%, var(--accent-end) 100%) !important;
            }
            .owl-carousel .owl-dots .owl-dot span {
                background: rgba(255, 255, 255, 0.3) !important; 
                transition: all 0.3s ease !important;
            }
            .owl-carousel .owl-dots .owl-dot.active span, .owl-carousel .owl-dots .owl-dot:hover span {
                background: var(--accent-start) !important;
            }

            /* Background pattern for subtle texture */
            body::before {
                content: '';
                position: fixed; /* Fixed so it doesn't scroll */
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                opacity: 0.02; /* Very subtle */
                background-image: 
                    radial-gradient(circle at 1px 1px, rgba(255,255,255,1) 1px, transparent 0), /* Tiny dots */
                    radial-gradient(circle at 25px 25px, rgba(255,255,255,1) 1px, transparent 0);
                background-size: 50px 50px;
                pointer-events: none; /* Allows clicking through */
                z-index: -1; /* Behind all content */
            }
            
            /* Custom Scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }
            ::-webkit-scrollbar-track {
                background: var(--primary-dark);
            }
            ::-webkit-scrollbar-thumb {
                background: linear-gradient(var(--accent-start), var(--accent-end));
                border-radius: 4px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(var(--accent-hover-start), var(--accent-hover-end));
            }

            /* Fix search form position and styling */
            .fixed-search-form {
                position: relative;
                width: 100%;
                z-index: 99;
            }
            
            .ticket-form { /* This rule might be general, ID specific one will be added */
                background-color: rgba(28, 22, 60, 0.85); /* Removed !important here if it was present, or ensure ID overrides */
                border-radius: 15px;
                backdrop-filter: blur(10px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                padding: 30px !important;
            }

            #search-form-card { /* Styles for the search form card */
                /* background-size, background-position, background-repeat, transition for background-image removed */
                /* This background-color will be a semi-transparent overlay. 
                   The backdrop-filter from .ticket-form will blur the hero image visible behind it. */
                background-color: rgba(28, 22, 60, 0.75) !important; 
                position: relative; /* For z-indexing content */
            }

            /* Ensure content inside search-form-card is visible */
            #search-form-card > * {
                position: relative;
                z-index: 1;
            }
            
            /* Fix search button text */
            .search-btn {
                height: auto !important;
                font-size: 1rem !important;
                font-weight: 600 !important;
                letter-spacing: 0.5px !important;
                background: linear-gradient(90deg, #FFD074, #FAECC5) !important;
                color: #1d1d1f !important;
                border: none !important;
                border-radius: 50px !important;
                padding: 12px 30px !important;
                transition: all 0.3s ease !important;
            }
            
            .search-btn:hover {
                background: linear-gradient(90deg, #FFD074, #FFBD45) !important;
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(255, 208, 116, 0.4);
            }
            
            /* Ensure the input fields stand out on the dark background */
            .fixed-search-form .form-control,
            .fixed-search-form .form-select {
                background-color: rgba(255, 255, 255, 0.1);
                color: var(--text-white);
                border: 1px solid rgba(255, 255, 255, 0.2);
                padding: 12px 16px;
                height: auto;
            }
            
            /* Ripple Button Style for Login/Register - From Uiverse.io by mi-series */
            .ripple-btn {
                outline: 0;
                display: inline-flex;
                align-items: center;
                justify-content: space-between;
                min-width: 120px;
                border: 0;
                border-radius: 4px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, .1);
                box-sizing: border-box;
                padding: 12px 16px;
                color: #fff;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: 1.2px;
                text-transform: uppercase;
                overflow: hidden;
                cursor: pointer;
                text-decoration: none;
                transition: all 0.3s ease;
                position: relative;
            }
            
            .ripple-btn:hover {
                opacity: .95;
                transform: translateY(-2px);
                box-shadow: 0 6px 15px rgba(0, 0, 0, .2);
            }
            
            .ripple-btn .animation {
                display: inline-block;
                width: 10px;
                height: 10px;
                margin: 0 8px;
                border-radius: 100%;
                animation: ripple 0.6s linear infinite;
                background: rgba(255, 255, 255, 0.1);
            }
            
            .ripple-login {
                background: var(--accent-start);
            }
            
            .ripple-register {
                background: linear-gradient(90deg, var(--accent-start) 0%, var(--accent-end) 100%);
            }
            
            @keyframes ripple {
                0% {
                    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1), 0 0 0 10px rgba(255, 255, 255, 0.1), 0 0 0 20px rgba(255, 255, 255, 0.1), 0 0 0 30px rgba(255, 255, 255, 0.1);
                }
            
                100% {
                    box-shadow: 0 0 0 10px rgba(255, 255, 255, 0.1), 0 0 0 20px rgba(255, 255, 255, 0.1), 0 0 0 30px rgba(255, 255, 255, 0.1), 0 0 0 40px rgba(255, 255, 255, 0);
                }
            }

            /* Ensure the input fields stand out on the dark background */
            .ticket-form .form-control,
            .ticket-form .form-select {
                background-color: rgba(255, 255, 255, 0.1);
                color: var(--text-white);
                border: 1px solid rgba(255, 255, 255, 0.2);
                padding: 12px 16px;
                height: auto;
            }
            
            /* Like Button Style - From Uiverse.io by LilaRest */
            .like-btn {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 8px 12px 8px 10px;
                box-shadow: rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
                background-color: #e8e8e8;
                border-color: #ffe2e2;
                border-style: solid;
                border-width: 5px;
                border-radius: 25px;
                font-size: 14px;
                cursor: pointer;
                font-weight: 900;
                color: rgb(134, 124, 124);
                font-family: monospace;
                transition:
                    transform 400ms cubic-bezier(0.68, -0.55, 0.27, 2.5),
                    border-color 400ms ease-in-out,
                    background-color 400ms ease-in-out;
                word-spacing: -2px;
                position: absolute;
                top: 15px;
                right: 15px;
                z-index: 10;
            }

            @keyframes movingBorders {
                0% {
                    border-color: #fce4e4;
                }

                50% {
                    border-color: #ffd8d8;
                }

                90% {
                    border-color: #fce4e4;
                }
            }

            .like-btn:hover {
                background-color: #eee;
                transform: scale(105%);
                animation: movingBorders 3s infinite;
            }

            .like-btn svg {
                margin-right: 5px;
                fill: rgb(255, 110, 110);
                transition: opacity 100ms ease-in-out;
                width: 20px;
                height: 20px;
            }

            .like-btn .filled {
                position: absolute;
                opacity: 0;
                left: 10px;
            }

            @keyframes beatingHeart {
                0% {
                    transform: scale(1);
                }

                15% {
                    transform: scale(1.15);
                }

                30% {
                    transform: scale(1);
                }

                45% {
                    transform: scale(1.15);
                }

                60% {
                    transform: scale(1);
                }
            }

            .like-btn:hover .empty {
                opacity: 0;
            }

            .like-btn:hover .filled {
                opacity: 1;
                animation: beatingHeart 1.2s infinite;
            }
            
            .like-btn.liked .empty {
                opacity: 0;
            }
            
            .like-btn.liked .filled {
                opacity: 1;
            }
            
            /* Fix for event card buttons */
            .event-card .card-body {
                position: relative;
                padding-bottom: 70px !important; /* Extra space for buttons at bottom */
            }
            
            .event-card .btn-group {
                position: absolute;
                bottom: 20px;
                left: 20px;
                right: 20px;
                display: flex;
                gap: 10px;
            }
            
            /* Better button styling for event cards */
            .event-card .btn-group > a,
            .event-card .btn-group > button,
            .event-card .btn-group > form {
                flex: 1;
            }
            
            .event-card .btn-group form {
                display: flex;
                flex: 1;
            }
            
            .event-card .btn-group form button {
                width: 100%;
            }

            /* Ensure consistent heights for the buttons */
            .consistent-btn-view, .book-now-btn, .btn-success-custom {
                height: 42px;
                line-height: 1;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            /* Fix for book-now-btn to have consistent width with other buttons */
            .book-now-btn {
                flex: 1;
                min-width: 0;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                background: transparent;
                color: #fff;
                font-size: 15px;
                font-weight: 600;
                border: none;
                padding: 10px 15px;
                cursor: pointer;
                perspective: 30rem;
                position: relative;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.308);
                width: 100%;
            }

            .book-now-btn::before {
              content: "";
              display: block;
              position: absolute;
              width: 100%;
              height: 100%;
              top: 0;
              left: 0;
              border-radius: 10px;
              background: linear-gradient(
                320deg,
                rgba(0, 140, 255, 0.678),
                rgba(128, 0, 128, 0.308)
              );
              z-index: 1;
              transition: background 3s;
            }

            .book-now-btn:hover::before {
              animation: rotate 1s;
              transition: all 0.5s;
            }

            .book-now-btn i, 
            .book-now-btn span {
              position: relative;
              z-index: 2;
            }

            .book-now-btn i {
              margin-right: 8px;
            }

            @keyframes rotate {
              0% {
                transform: rotateY(180deg);
              }

              100% {
                transform: rotateY(360deg);
              }
            }

            /* Add retro search input styling */
            .grid {
              height: 800px;
              width: 800px;
              background-image: linear-gradient(to right, #4d4030 1px, transparent 1px),
                linear-gradient(to bottom, #4d4030 1px, transparent 1px);
              background-size: 1rem 1rem;
              background-position: center center;
              position: absolute;
              z-index: -1;
              filter: blur(1px);
            }

            .white,
            .border,
            .darkBorderBg,
            .glow {
              max-height: 70px;
              max-width: 314px;
              height: 100%;
              width: 100%;
              position: absolute;
              overflow: hidden;
              z-index: -1;
              border-radius: 12px;
              filter: blur(3px);
            }

            .retro-input {
              background-color: #f2e2c4; /* Muted beige for retro */
              color: #3a2e20; /* Dark brown for contrast */
              border: none;
              width: 100%;
              height: 56px;
              border-radius: 10px;
              padding-inline: 59px;
              font-size: 18px;
            }

            #poda {
              display: flex;
              align-items: center;
              justify-content: center;
              position: relative;
              width: 100%;
              margin-bottom: 15px;
            }

            .retro-input::placeholder {
              color: #857754; /* Soft, warm brown */
            }

            .retro-input:focus {
              outline: none;
            }

            #main:focus-within > #input-mask {
              display: none;
            }

            #input-mask {
              pointer-events: none;
              width: 100px;
              height: 20px;
              position: absolute;
              background: linear-gradient(90deg, transparent, #3a2e20);
              top: 18px;
              left: 70px;
            }

            #pink-mask {
              pointer-events: none;
              width: 30px;
              height: 20px;
              position: absolute;
              background: #f28e8e; /* Warm coral */
              top: 10px;
              left: 5px;
              filter: blur(20px);
              opacity: 0.8;
              transition: all 2s;
            }

            #main:hover > #pink-mask {
              opacity: 0;
            }

            .white {
              max-height: 63px;
              max-width: 307px;
              border-radius: 10px;
              filter: blur(2px);
            }

            .white::before {
              content: "";
              z-index: -2;
              text-align: center;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%) rotate(83deg);
              position: absolute;
              width: 600px;
              height: 600px;
              background-repeat: no-repeat;
              background-position: 0 0;
              filter: brightness(1.4);
              background-image: conic-gradient(
                rgba(0, 0, 0, 0) 0%,
                #dcb483,
                rgba(0, 0, 0, 0) 8%,
                rgba(0, 0, 0, 0) 50%,
                #d16e5a,
                rgba(0, 0, 0, 0) 58%
              );
              transition: all 2s;
            }

            .border {
              max-height: 59px;
              max-width: 303px;
              border-radius: 11px;
              filter: blur(0.5px);
            }

            .border::before {
              content: "";
              z-index: -2;
              text-align: center;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%) rotate(70deg);
              position: absolute;
              width: 600px;
              height: 600px;
              filter: brightness(1.3);
              background-repeat: no-repeat;
              background-position: 0 0;
              background-image: conic-gradient(
                #3a2e20,
                #c98f65 5%,
                #3a2e20 14%,
                #3a2e20 50%,
                #f28e8e,
                #3a2e20 64%
              );
              transition: all 2s;
            }

            .darkBorderBg {
              max-height: 65px;
              max-width: 312px;
            }

            .darkBorderBg::before {
              content: "";
              z-index: -2;
              text-align: center;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%) rotate(82deg);
              position: absolute;
              width: 600px;
              height: 600px;
              background-repeat: no-repeat;
              background-position: 0 0;
              background-image: conic-gradient(
                rgba(0, 0, 0, 0),
                #725d4a,
                rgba(0, 0, 0, 0) 10%,
                rgba(0, 0, 0, 0) 50%,
                #d16e5a,
                rgba(0, 0, 0, 0) 60%
              );
              transition: all 2s;
            }

            #poda:hover > .darkBorderBg::before,
            #poda:focus-within > .darkBorderBg::before {
              transform: translate(-50%, -50%) rotate(262deg);
              transition: all 4s; /* Added transition for focus-within */
            }

            #poda:hover > .glow::before,
            #poda:focus-within > .glow::before {
              transform: translate(-50%, -50%) rotate(240deg);
              transition: all 4s; /* Added transition for focus-within */
            }

            #poda:hover > .white::before,
            #poda:focus-within > .white::before {
              transform: translate(-50%, -50%) rotate(263deg);
              transition: all 4s; /* Added transition for focus-within */
            }

            #poda:hover > .border::before,
            #poda:focus-within > .border::before {
              transform: translate(-50%, -50%) rotate(250deg);
              transition: all 4s; /* Added transition for focus-within */
            }

            .glow {
              overflow: hidden;
              filter: blur(30px);
              opacity: 0.4;
              max-height: 130px;
              max-width: 354px;
            }

            .glow::before {
              content: "";
              z-index: -2;
              text-align: center;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%) rotate(60deg);
              position: absolute;
              width: 999px;
              height: 999px;
              background-repeat: no-repeat;
              background-position: 0 0;
              background-image: conic-gradient(
                #000,
                #c98f65 5%,
                #000 38%,
                #000 50%,
                #f28e8e,
                #000 87%
              );
              transition: all 2s;
            }

            #filter-icon {
              position: absolute;
              top: 8px;
              right: 8px;
              display: flex;
              align-items: center;
              justify-content: center;
              z-index: 2;
              max-height: 40px;
              max-width: 38px;
              height: 100%;
              width: 100%;
              isolation: isolate;
              overflow: hidden;
              border-radius: 10px;
              background: linear-gradient(180deg, #a57d52, #846846, #6b5342);
              border: 1px solid transparent;
            }

            .filterBorder {
              height: 42px;
              width: 40px;
              position: absolute;
              overflow: hidden;
              top: 7px;
              right: 7px;
              border-radius: 10px;
            }

            .filterBorder::before {
              content: "";
              text-align: center;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%) rotate(90deg);
              position: absolute;
              width: 600px;
              height: 600px;
              background-repeat: no-repeat;
              background-position: 0 0;
              filter: brightness(1.35);
              background-image: conic-gradient(
                rgba(0, 0, 0, 0),
                #a57d52,
                rgba(0, 0, 0, 0) 50%,
                rgba(0, 0, 0, 0) 50%,
                #a57d52,
                rgba(0, 0, 0, 0) 100%
              );
              animation: rotate 4s linear infinite;
            }

            #main {
              position: relative;
              font-family: "Courier New", Courier, monospace; /* Retro-style font */
              width: 100%;
            }

            #search-icon {
              position: absolute;
              left: 20px;
              top: 15px;
              color: #c98f65;
              z-index: 2;
            }

            @keyframes rotate {
              100% {
                transform: translate(-50%, -50%) rotate(450deg);
              }
            }

            .event-like-btn-wrapper {
                position: absolute;
                top: 12px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 10;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .like-btn {
                background: linear-gradient(135deg, #23243a 60%, #3a3456 100%);
                color: #fff;
                border: none;
                border-radius: 50%;
                width: 44px;
                height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 8px rgba(0,0,0,0.18);
                transition: background 0.2s, box-shadow 0.2s;
                font-size: 1.2rem;
                cursor: pointer;
                outline: none;
            }
            .like-btn.liked {
                background: linear-gradient(135deg, #c06c84 60%, #6c5b7b 100%);
                color: #fff;
            }
            .like-btn:disabled {
                opacity: 0.6;
                cursor: not-allowed;
            }
        </style>
    </head>

    <body>
        <!-- Add a wrapper for the background pattern to apply to body correctly -->
        <div class="bg-pattern-container"></div>

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
                    <h1><span class="logo-icon">E</span>ventify</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                        <a href="#home" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="#" class="nav-item nav-link">Event</a>
                        
                        
                    </div>
                    <div class="d-flex align-items-center">
                        <!-- Search Icon -->
                        <a href="#" class="nav-item nav-link me-3"><i class="fas fa-search text-white"></i></a>
                        
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
                            <a href="{{ route('login') }}" class="ripple-btn ripple-login me-2"><i class="animation"></i>LOGIN<i class="animation"></i></a>
                            <a href="{{ route('register') }}" class="ripple-btn ripple-register"><i class="animation"></i>REGISTER<i class="animation"></i></a>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Hero Section Wrapper Start -->
        <div class="hero-section-wrapper" style="position: relative;">
            <!-- Carousel Start -->
            <div id="home" class="header-carousel owl-carousel position-relative">
                {{-- Search form removed from here --}}
                
                <div class="header-carousel-item">
                    <img src="{{ asset('asset/img/env2.jpg') }}" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="container py-4">
                            <div class="row g-5 align-items-center justify-content-center">
                                <div class="col-xl-6">
                                    <div class="text-center">
                                        <h4 class="text-primary text-uppercase fw-bold mb-4">Eventify</h4>
                                        <h1 class="display-5 text-white mb-4">Discover Amazing Events Near You</h1>
                                        <p class="fs-5 text-light mb-4">Find and attend events that match your interests, or create and manage your own events.</p>
                                        <div class="d-flex flex-shrink-0 justify-content-center">
                                            <a class="consistent-btn-carousel me-3" href="{{ route('events.index') }}">Explore Events</a>
                                            <a class="consistent-btn-carousel-light" href="{{ route('events.create') }}">Organize an Event</a>
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
                            <div class="row g-5 align-items-center justify-content-center">
                                <div class="col-xl-6">
                                    <div class="text-center">
                                        <h4 class="text-primary text-uppercase fw-bold mb-4">Eventify</h4>
                                        <h1 class="display-5 text-white mb-4">The Ultimate Event Management Platform</h1>
                                        <p class="fs-5 text-light mb-4">Create, manage, and promote your events with powerful tools designed for success.</p>
                                        <div class="d-flex flex-shrink-0 justify-content-center">
                                            <a class="consistent-btn-carousel me-3" href="{{ route('events.index') }}">Explore Events</a>
                                            <a class="consistent-btn-carousel-light" href="{{ route('events.create') }}">Organize an Event</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel End -->

            <!-- Fixed Search Form Overlay - MOVED HERE, outside carousel but inside hero-section-wrapper -->
            <div class="fixed-search-form position-absolute" style="top: 80px; right: 30px; left: auto; z-index: 1000; width: 350px; max-width: 90%;">
                <div class="ticket-form" id="search-form-card">
                    <h2 class="text-white text-uppercase mb-4 text-center">SEARCH EVENTS</h2>
                    <form action="{{ route('events.search') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="search-container">
                                    <div class="grid"></div>
                                    <div id="poda">
                                        <div class="glow"></div>
                                        <div class="darkBorderBg"></div>
                                        <div class="darkBorderBg"></div>
                                        <div class="darkBorderBg"></div>
                                        <div class="white"></div>
                                        <div class="border"></div>

                                        <div id="main">
                                            <input class="retro-input" name="keyword" type="text" placeholder="Search events..." />
                                            <div id="pink-mask"></div>
                                            <div class="filterBorder"></div>
                                            <div id="filter-icon">
                                                <svg fill="none" viewBox="4.8 4.56 14.832 15.408" width="27" height="27" preserveAspectRatio="none">
                                                    <path stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1" stroke="#d6d6e6" d="M8.16 6.65002H15.83C16.47 6.65002 16.99 7.17002 16.99 7.81002V9.09002C16.99 9.56002 16.7 10.14 16.41 10.43L13.91 12.64C13.56 12.93 13.33 13.51 13.33 13.98V16.48C13.33 16.83 13.1 17.29 12.81 17.47L12 17.98C11.24 18.45 10.2 17.92 10.2 16.99V13.91C10.2 13.5 9.97 12.98 9.73 12.69L7.52 10.36C7.23 10.08 7 9.55002 7 9.20002V7.87002C7 7.17002 7.52 6.65002 8.16 6.65002Z"></path>
                                                </svg>
                                            </div>
                                            <div id="search-icon">
                                                <svg class="feather feather-search" fill="none" height="24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="11" cy="11" r="8" stroke="url(#search)"></circle>
                                                    <line x1="22" x2="16.65" y1="22" y2="16.65" stroke="url(#searchl)"></line>
                                                    <defs>
                                                        <linearGradient id="search" gradientTransform="rotate(50)">
                                                            <stop offset="0%" stop-color="#f8e7f8"></stop>
                                                            <stop offset="50%" stop-color="#b6a9b7"></stop>
                                                        </linearGradient>
                                                        <linearGradient id="searchl">
                                                            <stop offset="0%" stop-color="#b6a9b7"></stop>
                                                            <stop offset="50%" stop-color="#837484"></stop>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <select name="type" class="form-select" aria-label="Default select example">
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
                                <input name="date" class="form-control" type="date" placeholder="Select Date">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="search-btn btn btn-primary w-100">Search Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Hero Section Wrapper End -->

        <!-- Categories Filter End -->

        <!-- Featured Events Start (Replacing Category Events) -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                
                
                <!-- Category Filter Carousel -->
                <div class="container-fluid attractions px-0">
                    <div class="attractions-section py-5">
                        <div class="section-title-container text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                            <h4 class="text-uppercase">Events Categories</h4>
                            <h1 class="display-5 text-white mb-4">Explore Our Events Categories</h1>
                            
                        </div>
                        
                        <!-- Replace owl carousel with optimized CSS animation -->
                        <div class="attraction-slider wow fadeInUp" data-wow-delay="0.1s">
                            <div class="slider-track">
                                <!-- Original set -->
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.2s">
                                    <img src="{{ asset('asset/img/env1.jpg') }}" alt="Conference">
                                    <a href="{{ route('events.search', ['type' => 'Conference']) }}" class="attractions-name">
                                        <i class="fas fa-chalkboard-teacher me-2"></i>Conferences
                                    </a>
                                </div>
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.3s">
                                    <img src="{{ asset('asset/img/env2.jpg') }}" alt="Workshop">
                                    <a href="{{ route('events.search', ['type' => 'Workshop']) }}" class="attractions-name">
                                        <i class="fas fa-laptop-code me-2"></i>Workshops
                                    </a>
                                </div>
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.4s">
                                    <img src="{{ asset('asset/img/env3.jpg') }}" alt="Seminar">
                                    <a href="{{ route('events.search', ['type' => 'Seminar']) }}" class="attractions-name">
                                        <i class="fas fa-book-reader me-2"></i>Seminars
                                    </a>
                                </div>
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.5s">
                                    <img src="{{ asset('asset/img/env4.jpg') }}" alt="Networking">
                                    <a href="{{ route('events.search', ['type' => 'Networking']) }}" class="attractions-name">
                                        <i class="fas fa-handshake me-2"></i>Networking
                                    </a>
                                </div>
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.6s">
                                    <img src="{{ asset('asset/img/env5.jpg') }}" alt="Training">
                                    <a href="{{ route('events.search', ['type' => 'Training']) }}" class="attractions-name">
                                        <i class="fas fa-graduation-cap me-2"></i>Training
                                    </a>
                                </div>
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.7s">
                                    <img src="{{ asset('asset/img/env9.jpg') }}" alt="Exhibition">
                                    <a href="{{ route('events.search', ['type' => 'Exhibition']) }}" class="attractions-name">
                                        <i class="fas fa-building me-2"></i>Exhibition
                                    </a>
                                </div>
                                
                                <!-- Clone set for continuous scrolling -->
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.2s"> <!-- Delays can repeat for the cloned set -->
                                    <img src="{{ asset('asset/img/env1.jpg') }}" alt="Conference">
                                    <a href="{{ route('events.search', ['type' => 'Conference']) }}" class="attractions-name">
                                        <i class="fas fa-chalkboard-teacher me-2"></i>Conferences
                                    </a>
                                </div>
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.3s">
                                    <img src="{{ asset('asset/img/env2.jpg') }}" alt="Workshop">
                                    <a href="{{ route('events.search', ['type' => 'Workshop']) }}" class="attractions-name">
                                        <i class="fas fa-laptop-code me-2"></i>Workshops
                                    </a>
                                </div>
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.4s">
                                    <img src="{{ asset('asset/img/env3.jpg') }}" alt="Seminar">
                                    <a href="{{ route('events.search', ['type' => 'Seminar']) }}" class="attractions-name">
                                        <i class="fas fa-book-reader me-2"></i>Seminars
                                    </a>
                                </div>
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.5s">
                                    <img src="{{ asset('asset/img/env4.jpg') }}" alt="Networking">
                                    <a href="{{ route('events.search', ['type' => 'Networking']) }}" class="attractions-name">
                                        <i class="fas fa-handshake me-2"></i>Networking
                                    </a>
                                </div>
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.6s">
                                    <img src="{{ asset('asset/img/env5.jpg') }}" alt="Training">
                                    <a href="{{ route('events.search', ['type' => 'Training']) }}" class="attractions-name">
                                        <i class="fas fa-graduation-cap me-2"></i>Training
                                    </a>
                                </div>
                                <div class="attraction-item wow fadeInUp" data-wow-delay="0.7s">
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
                <div class="row mb-5 events-container">
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="text-white"><i class="fas fa-chalkboard-teacher me-2"></i> Conferences</h3>
                            <a href="{{ route('events.search', ['type' => 'Conference']) }}" class="consistent-btn-view-all">View All <i class="fas fa-arrow-right"></i></a>
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
                                <!-- Like Button Center Top -->
                                <div class="event-like-btn-wrapper">
                                    @php
                                        $user = auth()->user();
                                        $isParticipant = $user && $event->registrations()->where('user_id', $user->id)->exists();
                                        $hasLiked = $user && $user->likedEvents()->where('event_id', $event->id)->exists();
                                    @endphp
                                    <button
                                        class="like-btn{{ $hasLiked ? ' liked' : '' }}"
                                        data-event-id="{{ $event->id }}"
                                        {!! !$user ? "onclick=\"window.location.href='".route('login')."'\" title=\"Login to like this event\"" : "" !!}
                                        {!! $user && !$isParticipant ? "disabled title=\"You must participate in this event to like it\"" : "" !!}
                                    >
                                        <svg class="empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                            <path fill="none" d="M0 0H24V24H0z"></path>
                                            <path d="M16.5 3C19.538 3 22 5.5 22 9c0 7-7.5 11-10 12.5C9.5 20 2 16 2 9c0-3.5 2.5-6 5.5-6C9.36 3 11 4 12 5c1-1 2.64-2 4.5-2zm-3.566 15.604c.881-.556 1.676-1.109 2.42-1.701C18.335 14.533 20 11.943 20 9c0-2.36-1.537-4-3.5-4-1.076 0-2.24.57-3.086 1.414L12 7.828l-1.414-1.414C9.74 5.57 8.576 5 7.5 5 5.56 5 4 6.656 4 9c0 2.944 1.666 5.533 4.645 7.903.745.592 1.54 1.145 2.421 1.7.299.189.595.37.934.572.339-.202.635-.383.934-.571z"></path>
                                        </svg>
                                        <svg class="filled" height="20" width="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0H24V24H0z" fill="none"></path>
                                            <path d="M16.5 3C19.538 3 22 5.5 22 9c0 7-7.5 11-10 12.5C9.5 20 2 16 2 9c0-3.5 2.5-6 5.5-6C9.36 3 11 4 12 5c1-1 2.64-2 4.5-2z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Badges -->
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
                                
                                <div class="event-info">
                                    <i class="far fa-calendar-alt"></i>
                                    <small>{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</small>
                                </div>
                                
                                <div class="event-info">
                                    <i class="far fa-clock"></i>
                                    <small>{{ \Carbon\Carbon::parse($event->start_date)->format('h:i A') }}</small>
                                </div>
                                
                                <div class="event-info">
                                    <i class="fas fa-map-marker-alt"></i>
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
                                        <div class="event-price">
                                            ${{ number_format($event->price, 2) }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="btn-group">
                                    <a href="{{ route('events.show', $event) }}" class="consistent-btn-view">
                                        <i class="fas fa-info-circle me-2"></i>View Details
                                    </a>
                                    @auth
                                        @if(!$event->registrations()->where('user_id', auth()->id())->exists())
                                            <form action="{{ route('registrations.store', $event) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="ticket_quantity" value="1">
                                                <button type="submit" class="book-now-btn">
                                                    <i class="fas fa-ticket-alt"></i>
                                                    <span>Book Now</span>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn-success-custom" disabled>
                                                <i class="fas fa-check-circle me-2"></i>Already Booked
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="book-now-btn">
                                            <i class="fas fa-ticket-alt"></i>
                                            <span>Book Now</span>
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
                            <a href="{{ route('events.index') }}" class="consistent-btn-view-all">View All Events <i class="fas fa-arrow-right"></i></a>
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
                                
                                <div class="btn-group">
                                    <a href="{{ route('events.show', $event) }}" class="consistent-btn-view">
                                        <i class="fas fa-info-circle me-2"></i>View Details
                                    </a>
                                    @auth
                                        @if(!$event->registrations()->where('user_id', auth()->id())->exists())
                                            <form action="{{ route('registrations.store', $event) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="ticket_quantity" value="1">
                                                <button type="submit" class="book-now-btn">
                                                    <i class="fas fa-ticket-alt"></i>
                                                    <span>Book Now</span>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn-success-custom" disabled>
                                                <i class="fas fa-check-circle me-2"></i>Already Booked
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="book-now-btn">
                                            <i class="fas fa-ticket-alt"></i>
                                            <span>Book Now</span>
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
                <!-- How It Works End -->

        <!-- Feature Start -->
        
        <!-- Feature End -->

        

                <!-- Benefits of Choosing Eventify -->
                
        <!-- About End -->

        <!-- Service Start -->
        <div id="services" class="container-fluid service py-5" style="background: url('{{ asset('asset/img/env14.jpg') }}') center center/cover no-repeat fixed;">
            <div class="container service-section py-5">
                <div class="section-title-container text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-uppercase">Our Services</h4> <!-- Changed from text-primary -->
                    <h1 class="display-5 mb-4">Comprehensive Event Management Solutions</h1> <!-- text-white is default for h1 -->
                    <p class="mb-0 text-muted">From event planning to execution, we provide end-to-end solutions for all your event management needs. Our platform offers powerful tools and features to make your events successful.</p> <!-- text-white to text-muted -->
                </div>
                <div class="row g-4 justify-content-center">
                    <!-- Opening Hours Info - Should be styled by .service-days CSS -->
                    
                </div>
                
                    <!-- Service Items -->
                    
            </div>
        </div>
        <!-- Service End -->

        <!-- Ticket Packages Start -->
       
        <!-- Ticket Packages End -->

        <!-- Contact Start -->
        <div id="contact" class="container-fluid py-5">
            <div class="container py-5">
                <div class="section-title-container text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-uppercase">Contact Us</h4> <!-- text-uppercase -->
                    <h1 class="display-5 mb-4">Get In Touch For Any Query</h1>
                    <p class="mb-0 text-muted">Have questions about our event management platform? Need help planning your next event? Contact us today and our team will be happy to assist you with any inquiries.</p> <!-- text-muted -->
                </div>
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 h-100"> <!-- bg-light for card style, h-100 -->
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-map-marker-alt text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2 text-white">Our Office</h5>
                                        <p class="mb-0 text-muted">123 Event Street, City, Country</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 h-100">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-phone text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2 text-white">Call Us</h5>
                                        <p class="mb-0 text-muted">+012 345 6789</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 h-100">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-envelope text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2 text-white">Email Us</h5>
                                        <p class="mb-0 text-muted">info@eventify.com</p> <!-- Updated email -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex bg-light p-4 h-100">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center bg-primary rounded-circle p-3 me-3" style="width: 64px; height: 64px;">
                                        <i class="fa fa-clock text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2 text-white">Office Hours</h5>
                                        <p class="mb-0 text-muted">Mon-Fri: 9am-6pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="mb-4 text-muted">Our dedicated support team is ready to assist you with any questions or concerns about our event management platform. We're committed to helping you create successful and memorable events.</p> <!-- text-muted -->
                        <div class="d-flex align-items-center social-icons"> <!-- use social-icons class -->
                            <a class="social-icon me-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="social-icon me-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="social-icon me-2" href=""><i class="fab fa-instagram"></i></a>
                            <a class="social-icon" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="contact-form p-4 p-md-5"> <!-- Added contact-form class and padding -->
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
                                        <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button> <!-- Adjusted padding, w-100 -->
                                    </div>
                                </div>
                            </form>
                        </div>
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
                        <h4 class="text-white mb-4">About Eventify</h4> <!-- Updated name -->
                        <p class="mb-4 text-muted">Your premier platform for discovering, managing, and organizing events. Join our community of professionals and make your events a success.</p> <!-- text-muted -->
                        <div class="d-flex pt-3 social-icons"> <!-- use social-icons class -->
                            <a class="social-icon me-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="social-icon me-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="social-icon me-2" href=""><i class="fab fa-instagram"></i></a>
                            <a class="social-icon me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h4 class="text-white mb-4">Quick Links</h4>
                        <div class="d-flex flex-column">
                            <a class="mb-2" href="#about"><i class="fas fa-angle-right me-2"></i>About Us</a> <!-- Updated href -->
                            <a class="mb-2" href="#contact"><i class="fas fa-angle-right me-2"></i>Contact Us</a> <!-- Updated href -->
                            <a class="mb-2" href="#services"><i class="fas fa-angle-right me-2"></i>Our Services</a> <!-- Updated href -->
                            <a class="mb-2" href="#"><i class="fas fa-angle-right me-2"></i>Terms & Conditions</a>
                            <a class="" href="#"><i class="fas fa-angle-right me-2"></i>Privacy Policy</a> <!-- Removed mb-2 from last item -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h4 class="text-white mb-4">Contact Info</h4>
                        <p class="mb-2 text-muted"><i class="fas fa-map-marker-alt text-primary me-3"></i>123 Event Street, City, Country</p> <!-- text-muted, icon text-primary -->
                        <p class="mb-2 text-muted"><i class="fas fa-phone-alt text-primary me-3"></i>+012 345 67890</p> <!-- text-muted, icon text-primary -->
                        <p class="mb-2 text-muted"><i class="fas fa-envelope text-primary me-3"></i>info@eventify.com</p> <!-- text-muted, icon text-primary, updated email -->
                        <!-- Removed duplicate social icons from here as they are in the first column -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Eventify</a>, All right reserved.</span> <!-- Updated name -->
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <span class="text-light">Designed By <a href="#" class="text-light">Eventify Team</a></span> <!-- Updated name -->
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
                
                // Prevent search form from triggering carousel navigation
                $('.fixed-search-form-inner input, .fixed-search-form-inner select, .fixed-search-form-inner button').on('click focus keydown', function(e) {
                    e.stopPropagation();
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
                
                // Apply the custom button styling
                $('.btn:not(.dropdown-toggle):not(.navbar-toggler):not([disabled]):not(.disabled):not(.search-btn)')
                    .not('button[type="submit"].dropdown-item')
                    .each(function() {
                        // Skip if this button already has been processed
                        if ($(this).find('.button-bg').length > 0) return;
                        
                        var btnText = $(this).html();
                        // Create wrapper for the text content
                        $(this).html(`
                            <span class="button-bg">
                                <span class="button-bg-layers">
                                    <span class="button-bg-layer button-bg-layer-1 -purple"></span>
                                    <span class="button-bg-layer button-bg-layer-2 -turquoise"></span>
                                    <span class="button-bg-layer button-bg-layer-3 -yellow"></span>
                                </span>
                            </span>
                            <span class="button-inner">
                                <span class="button-inner-static">${btnText}</span>
                                <span class="button-inner-hover">${btnText}</span>
                            </span>
                        `);
                        
                        // Add button class for styling
                        $(this).addClass('button button-item');
                    });
                    
                // Animation for the ripple buttons
                $('.ripple-btn').each(function() {
                    // Ensure ripple buttons are styled properly
                    $(this).css({
                        'color': 'white',
                        'text-decoration': 'none'
                    });
                    
                    // When hovering over a ripple button, increase animation speed
                    $(this).hover(
                        function() {
                            $(this).find('.animation').css('animation-duration', '0.4s');
                        }, 
                        function() {
                            $(this).find('.animation').css('animation-duration', '0.6s');
                        }
                    );
                });
                
                // Handle like button functionality
                $('.like-btn').on('click', function(e) {
                    e.preventDefault();
                    
                    const btn = $(this);
                    const eventId = btn.data('event-id');
                    
                    // Toggle the liked class for immediate visual feedback
                    btn.toggleClass('liked');
                    
                    // Send AJAX request to the server to toggle the like
                    $.ajax({
                        url: '/events/' + eventId + '/like',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // If the server responded with a success message, keep the visual state
                            // Otherwise, revert back to the previous state
                            if (!response.success) {
                                btn.toggleClass('liked');
                            }
                        },
                        error: function() {
                            // On error, revert back to the previous state
                            btn.toggleClass('liked');
                            alert('Failed to like/unlike the event. Please try again.');
                        }
                    });
                });

                // Script for changing search form background
                const searchCard = $('#search-form-card');
                if (searchCard.length) {
                    const searchFormImageUrls = [
                        "{{ asset('asset/img/search_bg_1.jpg') }}", // PLEASE ADD THIS IMAGE: public/asset/img/search_bg_1.jpg
                        "{{ asset('asset/img/search_bg_2.jpg') }}"  // PLEASE ADD THIS IMAGE: public/asset/img/search_bg_2.jpg
                    ];
                    let currentSearchImageIndex = 0;

                    function changeSearchCardBackground() {
                        if (searchFormImageUrls.length === 0) return;
                        currentSearchImageIndex = (currentSearchImageIndex + 1) % searchFormImageUrls.length;
                        const imageUrl = searchFormImageUrls[currentSearchImageIndex];
                        searchCard.css('background-image', 'url("' + imageUrl + '")');
                    }

                    if (searchFormImageUrls.length > 0) {
                        // Set initial background
                        searchCard.css('background-image', 'url("' + searchFormImageUrls[0] + '")');
                        // Change background every 7 seconds
                        setInterval(changeSearchCardBackground, 7000); 
                    }
                }
            });
        </script>
    </body>
</html>