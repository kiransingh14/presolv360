<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNotificationRequest;
use App\Models\Notifications;
use App\Models\User;

class NotificationsController extends Controller
{
    public static function createNotification(CreateNotificationRequest $request)
    {
        $checkExisting = Notifications::where('user_id', $request->user_id)
            ->where('channel', $request->channel)
            ->where('type', $request->type)
            ->first();
        if ($checkExisting) {
            return response('Request already exists', 200);
        } else {
            $user = User::find($request->user_id);
            if (! $user) {
                return response('User not found', 400);
            }
            $newNotification = Notifications::insert([
                'user_id' => $request->user_id,
                'channel' => $request->channel,
                'type' => $request->type,
                'status' => 'pending',
                'contact' => $user->mobile,
                'message' => $request->message
            ]);
            if ($newNotification) {
                return response(["message"=>'New Notification saved successfully', "data"=>$newNotification], 200);
            }
        }

        return response('Error while saving new notification ', 500);

    }

    public static function getNotification()
    {
        $notificationList = Notifications::all();

        return response($notificationList, 200);
    }
}
