<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Laracasts\Flash\Flash;

class NotificationController extends Controller
{
    public function markAsRead(DatabaseNotification $notification)
    {
        $this->authorize('update', $notification);
        $notification->markAsRead();

        Flash::success("Notification acknowledged.");

        return redirect()->route('dashboard');
    }

    public function markAllAsRead(Request $request)
    {
        foreach ($request->user()->unreadNotifications as $notification) {
            $this->authorize('update', $notification);
            $notification->markAsRead();
        }

        Flash::success("All unread notifications acknowledged.");
        return redirect()->route('dashboard');
    }
}
