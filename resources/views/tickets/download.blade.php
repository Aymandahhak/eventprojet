@extends('layouts.participant')

@section('title', 'Billet - ' . $registration->event->title)

@section('dashboard-content')
<div class="container py-4 printable-ticket">
    @if(request()->has('preview'))
    <div class="row mb-4 d-print-none">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Aperçu du billet</h5>
                    <div>
                        <a href="{{ route('participant.tickets') }}" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                        <a href="{{ route('participant.tickets.download', $registration) }}" class="btn btn-sm btn-primary me-2">
                            <i class="fas fa-download me-1"></i> Télécharger PDF
                        </a>
                        <button onclick="window.print()" class="btn btn-sm btn-secondary">
                            <i class="fas fa-print me-1"></i> Imprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Ticket Container - This part will be rendered in the PDF -->
    <div class="row ticket-pdf-container">
        <div class="col-lg-10 mx-auto">
            <div class="ticket-card">
                <!-- Ticket Header -->
                <div class="ticket-header">
                    <div class="event-logo">
                        <i class="fas fa-calendar-alt"></i>
                        <span>EventORG</span>
                    </div>
                    <div class="event-title">
                        <h2>{{ $registration->event->title }}</h2>
                        <div class="event-date">
                            <i class="fas fa-calendar-day"></i>
                            <span>{{ \Carbon\Carbon::parse($registration->event->start_date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($registration->event->start_date)->format('H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Ticket Body -->
                <div class="ticket-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="ticket-details">
                                <div class="detail-group">
                                    <span class="detail-label">Lieu</span>
                                    <span class="detail-value">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $registration->event->location }}
                                    </span>
                                </div>
                                
                                <div class="detail-group">
                                    <span class="detail-label">Participant</span>
                                    <span class="detail-value">
                                        <i class="fas fa-user"></i>
                                        {{ $registration->user->name }}
                                    </span>
                                </div>
                                
                                <div class="detail-group">
                                    <span class="detail-label">Email</span>
                                    <span class="detail-value">
                                        <i class="fas fa-envelope"></i>
                                        {{ $registration->user->email }}
                                    </span>
                                </div>
                                
                                @if($registration->ticket_quantity)
                                <div class="detail-group">
                                    <span class="detail-label">Quantité</span>
                                    <span class="detail-value">
                                        <i class="fas fa-ticket-alt"></i>
                                        {{ $registration->ticket_quantity }} {{ $registration->ticket_quantity > 1 ? 'billets' : 'billet' }}
                                    </span>
                                </div>
                                @endif
                                
                                <div class="detail-group">
                                    <span class="detail-label">Statut</span>
                                    <span class="detail-value status-{{ $registration->status }}">
                                        <i class="fas fa-check-circle"></i>
                                        {{ ucfirst($registration->status) }}
                                    </span>
                                </div>
                                
                                <div class="detail-group">
                                    <span class="detail-label">Paiement</span>
                                    <span class="detail-value payment-{{ $registration->payment_status }}">
                                        <i class="fas fa-credit-card"></i>
                                        {{ ucfirst($registration->payment_status) }}
                                    </span>
                                </div>
                                
                                <div class="detail-group highlight">
                                    <span class="detail-label">Référence</span>
                                    <span class="detail-value ticket-code">
                                        <i class="fas fa-ticket-alt"></i>
                                        {{ $registration->ticket_code ?? strtoupper(substr(md5($registration->id), 0, 8)) . '-' . $registration->id }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="ticket-qr">
                                <div class="qr-code">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=EVT-REG-{{ $registration->id }}-{{ $registration->user_id }}-{{ $registration->created_at->timestamp }}" alt="QR Code" class="img-fluid">
                                </div>
                                <div class="qr-text">
                                    <p>Scannez ce QR code à l'entrée</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Ticket Footer -->
                <div class="ticket-footer">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="mb-1">Instructions:</p>
                            <ul class="mb-0 ps-3">
                                <li>Veuillez présenter ce billet (imprimé ou sur mobile) à l'entrée</li>
                                <li>Une pièce d'identité peut être demandée</li>
                                <li>Arrivez au moins 30 minutes avant le début de l'événement</li>
                            </ul>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <p class="ticket-date-issued mb-0">
                                Émis le: {{ $registration->created_at->format('d/m/Y H:i') }}
                            </p>
                            <p class="organizer-info mb-0">
                                Par: EventORG
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Ticket styles */
    .ticket-card {
        position: relative;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        background: white;
        margin-bottom: 30px;
        border: 1px solid rgba(0,0,0,0.1);
    }
    
    .ticket-header {
        background: linear-gradient(135deg, #607EBC 0%, #98AACF 100%);
        color: white;
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
    }
    
    .ticket-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 10px;
        background: repeating-linear-gradient(
            45deg,
            rgba(255,255,255,0.1),
            rgba(255,255,255,0.1) 10px,
            rgba(255,255,255,0.2) 10px,
            rgba(255,255,255,0.2) 20px
        );
    }
    
    .event-logo {
        display: flex;
        align-items: center;
        font-size: 1.5rem;
        font-weight: 700;
    }
    
    .event-logo i {
        font-size: 1.8rem;
        margin-right: 10px;
    }
    
    .event-title {
        text-align: right;
    }
    
    .event-title h2 {
        font-size: 1.8rem;
        margin-bottom: 8px;
        font-weight: 700;
    }
    
    .event-date {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }
    
    .event-date i {
        margin-right: 8px;
    }
    
    .ticket-body {
        padding: 25px;
        position: relative;
    }
    
    .ticket-body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 15px;
        right: 15px;
        height: 1px;
        background: rgba(0,0,0,0.1);
    }
    
    .ticket-details {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .detail-group {
        display: flex;
        flex-direction: column;
    }
    
    .detail-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        font-weight: 600;
        color: #888;
        margin-bottom: 5px;
    }
    
    .detail-value {
        font-size: 1.1rem;
        color: #333;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    
    .detail-value i {
        margin-right: 10px;
        color: #607EBC;
        width: 18px;
    }
    
    .status-confirmed,
    .payment-paid {
        color: #28a745;
    }
    
    .status-pending,
    .payment-pending {
        color: #ffc107;
    }
    
    .status-cancelled,
    .payment-failed {
        color: #dc3545;
    }
    
    .detail-group.highlight {
        background: rgba(96, 126, 188, 0.1);
        padding: 15px;
        border-radius: 10px;
        margin-top: 10px;
    }
    
    .ticket-code {
        font-size: 1.2rem;
        font-weight: 700;
        color: #607EBC;
        letter-spacing: 1px;
    }
    
    .ticket-qr {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }
    
    .qr-code {
        background: white;
        padding: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-radius: 10px;
        margin-bottom: 15px;
    }
    
    .qr-text {
        text-align: center;
        font-size: 0.9rem;
        color: #666;
    }
    
    .ticket-footer {
        padding: 20px 25px;
        background: rgba(96, 126, 188, 0.05);
        border-top: 1px dashed rgba(0,0,0,0.1);
        font-size: 0.9rem;
        color: #666;
    }
    
    .ticket-date-issued {
        color: #888;
        font-size: 0.85rem;
    }
    
    .organizer-info {
        font-weight: 600;
        color: #607EBC;
    }
    
    /* For better PDF rendering */
    .ticket-pdf-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }
    
    /* Print styles */
    @media print {
        .sidebar, 
        .welcome-section, 
        .profile-header,
        .navbar,
        .menu-toggle,
        .d-print-none,
        .btn,
        footer {
            display: none !important;
        }
        
        body {
            background: white !important;
        }
        
        .main-content {
            margin-left: 0 !important;
            padding: 0 !important;
            background: white !important;
        }
        
        .container {
            max-width: 100% !important;
            width: 100% !important;
        }
        
        .ticket-card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
            page-break-inside: avoid !important;
        }
        
        .ticket-header {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        
        .printable-ticket {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
        
        @page {
            margin: 0.5cm;
        }
    }
    
    /* Responsive styles */
    @media (max-width: 768px) {
        .event-title h2 {
            font-size: 1.4rem;
        }
        
        .event-logo {
            font-size: 1.2rem;
        }
        
        .event-logo i {
            font-size: 1.5rem;
        }
        
        .ticket-header {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }
        
        .event-title {
            text-align: center;
        }
        
        .event-date {
            justify-content: center;
        }
        
        .ticket-qr {
            margin-top: 30px;
        }
    }
</style>
@endsection 