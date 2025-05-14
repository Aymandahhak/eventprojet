<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Billet - {{ $registration->event->title }}</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', 'Helvetica', sans-serif;
            background: white;
            padding: 0;
            margin: 0;
            color: #333;
            font-size: 14px;
        }
        
        /* Ticket container */
        .ticket-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 0;
            background: white;
        }
        
        /* Ticket card */
        .ticket-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            margin: 0 auto;
            background: white;
        }
        
        /* Ticket header */
        .ticket-header {
            background: #607EBC;
            color: white;
            padding: 20px;
            position: relative;
        }
        
        .event-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .company-logo {
            text-align: center;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: bold;
        }
        
        .event-date {
            text-align: center;
            font-size: 16px;
        }
        
        /* Ticket body */
        .ticket-body {
            padding: 20px;
            display: block;
        }
        
        .ticket-info {
            width: 60%;
            float: left;
        }
        
        .ticket-qr {
            width: 40%;
            float: right;
            text-align: center;
        }
        
        .qr-image {
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }
        
        .qr-text {
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        
        /* Detail rows */
        .detail-group {
            margin-bottom: 12px;
        }
        
        .detail-label {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
            color: #666;
            margin-bottom: 3px;
        }
        
        .detail-value {
            font-size: 16px;
            color: #333;
        }
        
        /* Highlighted reference number */
        .highlight {
            background: #f0f3f8;
            padding: 15px;
            border-radius: 8px;
            margin-top: 12px;
        }
        
        .ticket-code {
            font-size: 18px;
            font-weight: bold;
            color: #607EBC;
            letter-spacing: 1px;
        }
        
        /* Footer */
        .ticket-footer {
            clear: both;
            padding: 20px;
            background: #f5f7fa;
            border-top: 1px dashed #ccc;
            margin-top: 20px;
        }
        
        .instructions {
            width: 70%;
            float: left;
        }
        
        .instructions ul {
            padding-left: 20px;
            margin-top: 5px;
        }
        
        .instructions li {
            margin-bottom: 5px;
        }
        
        .ticket-meta {
            width: 30%;
            float: right;
            text-align: right;
        }
        
        .ticket-date-issued {
            color: #888;
            font-size: 12px;
            margin-bottom: 5px;
        }
        
        .organizer-info {
            font-weight: bold;
            color: #607EBC;
        }
        
        /* Clearfix */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="ticket-card">
            <!-- Ticket Header -->
            <div class="ticket-header">
                <div class="company-logo">EventORG</div>
                <div class="event-title">{{ $registration->event->title }}</div>
                <div class="event-date">
                    {{ \Carbon\Carbon::parse($registration->event->start_date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($registration->event->start_date)->format('H:i') }}
                </div>
            </div>
            
            <!-- Ticket Body -->
            <div class="ticket-body clearfix">
                <div class="ticket-info">
                    <div class="detail-group">
                        <div class="detail-label">Lieu</div>
                        <div class="detail-value">{{ $registration->event->location }}</div>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Participant</div>
                        <div class="detail-value">{{ $registration->user->name }}</div>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Email</div>
                        <div class="detail-value">{{ $registration->user->email }}</div>
                    </div>
                    
                    @if($registration->ticket_quantity)
                    <div class="detail-group">
                        <div class="detail-label">Quantité</div>
                        <div class="detail-value">{{ $registration->ticket_quantity }} {{ $registration->ticket_quantity > 1 ? 'billets' : 'billet' }}</div>
                    </div>
                    @endif
                    
                    <div class="detail-group">
                        <div class="detail-label">Statut</div>
                        <div class="detail-value">{{ ucfirst($registration->status) }}</div>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Paiement</div>
                        <div class="detail-value">{{ ucfirst($registration->payment_status) }}</div>
                    </div>
                    
                    <div class="detail-group highlight">
                        <div class="detail-label">Référence</div>
                        <div class="detail-value ticket-code">
                            {{ $registration->ticket_code ?? strtoupper(substr(md5($registration->id), 0, 8)) . '-' . $registration->id }}
                        </div>
                    </div>
                </div>
                
                <div class="ticket-qr">
                    <img class="qr-image" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=EVT-REG-{{ $registration->id }}-{{ $registration->user_id }}-{{ $registration->created_at->timestamp }}" alt="QR Code">
                    <div class="qr-text">
                        <p>Scannez ce QR code à l'entrée</p>
                        <p style="font-weight:bold;">{{ $registration->ticket_code }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Ticket Footer -->
            <div class="ticket-footer clearfix">
                <div class="instructions">
                    <p>Instructions:</p>
                    <ul>
                        <li>Veuillez présenter ce billet à l'entrée de l'événement</li>
                        <li>Une pièce d'identité peut être demandée</li>
                        <li>Arrivez au moins 30 minutes avant le début de l'événement</li>
                    </ul>
                </div>
                <div class="ticket-meta">
                    <p class="ticket-date-issued">
                        Émis le: {{ $registration->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p class="organizer-info">
                        Par: EventORG
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 