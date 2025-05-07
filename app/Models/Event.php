<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'location_details',
        'category',
        'type',
        'max_participants',
        'is_free',
        'price',
        'image',
        'status',
        'organizer_id'
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'is_free' => 'boolean',
        'max_participants' => 'integer',
        'price' => 'decimal:2'
    ];

    /**
     * Obtenir l'organisateur de l'événement.
     */
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    /**
     * Obtenir les inscriptions pour cet événement.
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Vérifier si l'événement est complet.
     */
    public function isFull()
    {
        if (!$this->max_participants) {
            return false;
        }
        
        return $this->registrations()->count() >= $this->max_participants;
    }

    /**
     * Obtenir les événements à venir.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now())->orderBy('date', 'asc');
    }

    /**
     * Obtenir les événements passés.
     */
    public function scopePast($query)
    {
        return $query->where('date', '<', now())->orderBy('date', 'desc');
    }

    /**
     * Obtenir les événements publiés.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Get formatted price.
     */
    public function formattedPrice()
    {
        if ($this->is_free) {
            return 'Gratuit';
        }
        
        return number_format($this->price, 2) . ' €';
    }
}