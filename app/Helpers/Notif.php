<?php

use App\Models\Notification;
use App\Models\NotificationDetail;

function sendNotification($user_id, $transaction_id, $type, $message, $title = "")
{
    $notif = Notification::create([
        'user_id' => $user_id,
        'transaction_id' => $transaction_id,
        'type' => $type,
    ]);

    if ($notif) {
        NotificationDetail::create([
            'notification_id' => $notif->id,
            'title' => $title,
            'message' => $message,
        ]);
    }
}
