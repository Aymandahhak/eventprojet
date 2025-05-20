@extends('layouts.participant')

@section('title', 'My Notifications - Eventify')

@section('dashboard-content')
<div class="card content-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <i class="fas fa-bell text-purple me-2"></i>
            <h5 class="card-title mb-0">My Notifications</h5>
        </div>
        
        @if($notifications->count() > 0)
        <form action="{{ route('participant.notifications.mark-all-as-read') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-purple">
                <i class="fas fa-check-double me-1"></i> Mark All as Read
            </button>
        </form>
        @endif
    </div>
    
    <div class="card-body p-0">
        <div class="list-group notification-list">
            @forelse($notifications as $notification)
            <div class="list-group-item notification-item {{ $notification->is_read ? '' : 'unread' }}">
                <div class="d-flex">
                    <div class="notification-icon">
                        <i class="fas {{ $notification->icon ?? 'fa-bell' }} text-purple"></i>
                    </div>
                    <div class="notification-content flex-grow-1">
                        @if($notification->title)
                        <h6 class="notification-title mb-1">{{ $notification->title }}</h6>
                        @endif
                        <p class="notification-text mb-1">{{ $notification->message }}</p>
                        <small class="notification-time text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    @if(!$notification->is_read)
                    <div class="notification-actions ms-3">
                        <form action="{{ route('participant.notifications.mark-as-read', $notification) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light-purple">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="empty-state p-5 text-center">
                <i class="fas fa-bell-slash fa-3x text-purple mb-3"></i>
                <p class="mb-3">No notifications at this time.</p>
            </div>
            @endforelse
        </div>
    </div>
    
    @if($notifications->count() > 0)
    <div class="card-footer">
        {{ $notifications->links() }}
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .notification-list {
        max-height: none;
    }
    
    .notification-item {
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 1.5rem;
    }
    
    .notification-item.unread {
        background-color: rgba(107, 70, 193, 0.1);
    }
    
    .notification-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: 1rem;
        background-color: rgba(107, 70, 193, 0.15);
    }
    
    .notification-title {
        color: var(--text-white);
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .notification-text {
        color: var(--text-light);
    }
    
    .notification-time {
        font-size: 0.75rem;
    }
    
    .btn-light-purple {
        background-color: rgba(107, 70, 193, 0.15);
        color: var(--accent-start);
        border: none;
    }
    
    .btn-light-purple:hover {
        background-color: rgba(107, 70, 193, 0.25);
        color: var(--text-white);
    }
    
    .pagination {
        justify-content: center;
        margin-bottom: 0;
    }
    
    .page-item.active .page-link {
        background-color: var(--accent-start);
        border-color: var(--accent-start);
    }
    
    .page-link {
        color: var(--accent-start);
        background-color: transparent;
        border-color: var(--border-color);
    }
    
    .page-link:hover {
        color: var(--text-white);
        background-color: rgba(107, 70, 193, 0.15);
        border-color: var(--border-color);
    }
</style>
@endpush 