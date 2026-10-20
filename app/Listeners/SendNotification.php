<?php

namespace App\Listeners;

use App\Events\DispatchNotifications;
use App\Models\Notifications;
use Carbon\Carbon;

class SendNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DispatchNotifications $event): void
    {
        $id = $event->notificationId instanceof Notifications
            ? $event->notificationId->id
            : ($event->notificationId ?? $event->event);

        $notification = Notifications::where('id', $id)->where('status', 'pending')->first();

        if ($notification) {
            $notification->status = 'success';
            $notification->notification_sent_at = Carbon::now();
            $notification->save();
        }
    }
}
