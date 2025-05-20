<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventLikeController extends Controller
{
    /**
     * Toggle like/unlike for an event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function toggle(Request $request, Event $event)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'User must be logged in to like events'
            ], 401);
        }
        
        $user = Auth::user();
        
        // Check if user already liked this event
        $existingLike = $user->likedEvents()->where('event_id', $event->id)->first();
        
        if ($existingLike) {
            // Unlike the event
            $user->likedEvents()->detach($event->id);
            $message = 'Event unliked successfully';
            $isLiked = false;
        } else {
            // Like the event
            $user->likedEvents()->attach($event->id);
            $message = 'Event liked successfully';
            $isLiked = true;
        }
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'isLiked' => $isLiked,
            'likeCount' => $event->likes()->count()
        ]);
    }
}
