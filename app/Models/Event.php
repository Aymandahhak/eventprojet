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
        'category',
        'start_date',
        'end_date',
        'location',
        'price',
        'capacity',
        'image',
        'organizer_id',
        'is_published',
        'type'
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'price' => 'decimal:2',
        'is_published' => 'boolean'
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
     * Obtenir les participants pour cet événement.
     */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'registrations')
            ->withPivot(['status', 'payment_status'])
            ->withTimestamps();
    }

    /**
     * Obtenir les utilisateurs qui ont aimé cet événement.
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'event_likes')
            ->withTimestamps();
    }

    public function getRemainingCapacityAttribute()
    {
        return $this->capacity - $this->registrations()->where('status', 'confirmed')->count();
    }

    public function getIsFullAttribute()
    {
        return $this->remaining_capacity <= 0;
    }

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    public function getDurationAttribute()
    {
        return $this->start_date->diffForHumans($this->end_date, true);
    }

    /**
     * Obtenir les événements à venir.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    /**
     * Obtenir les événements passés.
     */
    public function scopePast($query)
    {
        return $query->where('end_date', '<', now());
    }

    /**
     * Obtenir les événements publiés.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Obtenir les événements en cours.
     */
    public function scopeCurrent($query)
    {
        return $query->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    public function getTypeAttribute($value)
    {
        return $value ?? 'Présentiel'; // Default to 'Présentiel' if not set
    }
}