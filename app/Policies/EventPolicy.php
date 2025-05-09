<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Event $event)
    {
        return $event->is_published || ($user && ($user->isAdmin() || $user->id === $event->organizer_id));
    }

    public function create(User $user)
    {
        return $user->isOrganizer() || $user->isAdmin();
    }

    public function update(User $user, Event $event)
    {
        return $user->isAdmin() || $user->id === $event->organizer_id;
    }

    public function delete(User $user, Event $event)
    {
        return $user->isAdmin() || $user->id === $event->organizer_id;
    }

    public function restore(User $user, Event $event)
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Event $event)
    {
        return $user->isAdmin();
    }
} 