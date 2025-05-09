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
        'payment_id'
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
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
        return $query->where('status', 'confirmed');
    }

    /**
     * Obtenir les inscriptions en attente.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Obtenir les inscriptions avec paiement effectué.
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Obtenir les inscriptions annulées.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Obtenir les inscriptions non payées.
     */
    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'pending');
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

    public function getIsConfirmedAttribute()
    {
        return $this->status === 'confirmed';
    }

    public function getIsCancelledAttribute()
    {
        return $this->status === 'cancelled';
    }

    public function getIsPendingAttribute()
    {
        return $this->status === 'pending';
    }

    public function getIsPaidAttribute()
    {
        return $this->payment_status === 'paid';
    }

    public function getFormattedStatusAttribute()
    {
        return ucfirst($this->status);
    }

    public function getFormattedPaymentStatusAttribute()
    {
        return ucfirst($this->payment_status);
    }
}