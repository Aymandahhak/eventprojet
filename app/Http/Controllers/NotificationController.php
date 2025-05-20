<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the user's notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->paginate(10);
        
        return view('dashboard.participant.notifications', [
            'notifications' => $notifications
        ]);
    }
    
    /**
     * Mark a notification as read.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request, Notification $notification)
    {
        // Check if the notification belongs to the authenticated user
        if ($notification->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You do not have permission to mark this notification as read.');
        }
        
        $notification->is_read = true;
        $notification->save();
        
        return redirect()->back()->with('success', 'Notification marked as read successfully.');
    }
    
    /**
     * Mark all notifications as read.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markAllAsRead(Request $request)
    {
        Auth::user()->notifications()->update(['is_read' => true]);
        
        return redirect()->back()->with('success', 'All notifications marked as read successfully.');
    }
}
