<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::with([
            'notif_detail',
            'transaction' => function ($query) {
                $query->select('id', 'transaction_id');
            }
        ])
            ->where('user_id', $request->user_id)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        return response()->json($notifications, 200);
    }
}
