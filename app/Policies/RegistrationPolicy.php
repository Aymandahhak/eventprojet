<?php

namespace App\Policies;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistrationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Registration $registration)
    {
        return $user->isAdmin() || 
               $user->id === $registration->user_id || 
               $user->id === $registration->event->organizer_id;
    }

    public function create(User $user)
    {
        return $user->isParticipant();
    }

    public function update(User $user, Registration $registration)
    {
        return $user->isAdmin() || 
               $user->id === $registration->user_id || 
               $user->id === $registration->event->organizer_id;
    }

    public function delete(User $user, Registration $registration)
    {
        return $user->isAdmin() || 
               $user->id === $registration->user_id || 
               $user->id === $registration->event->organizer_id;
    }

    public function restore(User $user, Registration $registration)
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Registration $registration)
    {
        return $user->isAdmin();
    }
} 