<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_name',
        'organization_type',
        'organization_description',
        'website',
        'social_media',
        'logo',
        'is_verified'
    ];

    /**
     * Get the user that owns the organizer profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
