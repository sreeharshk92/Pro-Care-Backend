<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function updateBookingStatus(Request $req)
    {
        $notifyFields = $req->validate([
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'message' => 'required|string',
            'status' => 'required',
        ]);

        $notification = Notification::create($notifyFields);

        return response()->json([
            'message' => 'Notfi success',
            'notification' => $notification
        ],201);
    }

    public function getUserNotifications($userId)
    {
      
        $notifications = Notification::where('user_id', $userId)->get();

        return response()->json($notifications);
    }
}
