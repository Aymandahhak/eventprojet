<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'user_id',
        'status',
        'payment_status',
        'ticket_number',
        'amount_paid',
        'payment_method',
        'payment_id',
        'attended'
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'attended' => 'boolean',
        'amount_paid' => 'decimal:2'
    ];

    /**
     * Obtenir l'événement associé à cette inscription.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Obtenir l'utilisateur associé à cette inscription.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Générer un numéro de ticket unique.
     */
    public static function generateTicketNumber()
    {
        return 'TIK-' . strtoupper(substr(uniqid(), -6)) . '-' . rand(1000, 9999);
    }

    /**
     * Obtenir les inscriptions confirmées.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmé');
    }

    /**
     * Obtenir les inscriptions en attente.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'en attente');
    }

    /**
     * Obtenir les inscriptions avec paiement effectué.
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'payé');
    }

    /**
     * Mark attendance for this registration.
     */
    public function markAttended()
    {
        $this->attended = true;
        $this->save();
        
        return $this;
    }
}