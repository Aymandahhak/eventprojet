@extends('layouts.participant')

@section('dashboard-title', 'Mon Billet')

@section('dashboard-content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Détails du billet</h5>
                    <a href="{{ route('participant.tickets') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i>Retour aux billets
                    </a>
                </div>
                
                <div class="ticket-container my-4">
                    <div class="row">
                        <div class="col-lg-10 mx-auto">
                            <div class="ticket-card border">
                                <div class="ticket-header text-center p-4 bg-primary text-white">
                                    <h4 class="mb-0">EventORG</h4>
                                    <p class="mb-0">Billet d'entrée</p>
                                </div>
                                <div class="ticket-body p-4">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h3 class="event-title mb-3">{{ $registration->event->title }}</h3>
                                            
                                            <div class="ticket-info mb-3">
                                                <div class="d-flex mb-2">
                                                    <div class="ticket-info-icon me-3">
                                                        <i class="fas fa-calendar-day text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0"><strong>Date:</strong></p>
                                                        <p class="mb-0">{{ \Carbon\Carbon::parse($registration->event->start_date)->format('d/m/Y') }}</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex mb-2">
                                                    <div class="ticket-info-icon me-3">
                                                        <i class="fas fa-clock text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0"><strong>Heure:</strong></p>
                                                        <p class="mb-0">{{ \Carbon\Carbon::parse($registration->event->start_date)->format('H:i') }}</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex mb-2">
                                                    <div class="ticket-info-icon me-3">
                                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0"><strong>Lieu:</strong></p>
                                                        <p class="mb-0">{{ $registration->event->location }}</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex mb-2">
                                                    <div class="ticket-info-icon me-3">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0"><strong>Participant:</strong></p>
                                                        <p class="mb-0">{{ $registration->user->name }}</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex mb-2">
                                                    <div class="ticket-info-icon me-3">
                                                        <i class="fas fa-ticket-alt text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0"><strong>Référence:</strong></p>
                                                        <p class="mb-0">{{ strtoupper(substr(md5($registration->id), 0, 8)) }}-{{ $registration->id }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 text-center">
                                            <div class="qr-code-container mb-3">
                                                <div class="qr-code bg-light p-3 d-inline-block">
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=EVT-{{ $registration->id }}-{{ $registration->user_id }}" alt="QR Code" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="ticket-status">
                                                <span class="badge bg-success p-2 w-100">{{ ucfirst($registration->status) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ticket-footer p-3 bg-light border-top">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <p class="mb-0 small text-muted">Veuillez présenter ce billet à l'entrée de l'événement.</p>
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                            <button onclick="window.print()" class="btn btn-primary rounded-pill">
                                                <i class="fas fa-print me-2"></i>Imprimer le billet
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ticket-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .ticket-header {
        border-bottom: 2px dashed #eee;
    }
    
    .ticket-info-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    @media print {
        .dashboard-sidebar, .dashboard-header, .navbar, .footer, .btn-print {
            display: none !important;
        }
        
        .container-fluid {
            padding: 0 !important;
            margin: 0 !important;
        }
        
        .main-content {
            box-shadow: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .ticket-card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
    }
</style>
@endsection 