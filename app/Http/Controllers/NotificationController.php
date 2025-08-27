<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use App\Models\User;
use App\Notifications\SendNotification;
use App\Notifications\StoreNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        try {
            $data = [];
            $notifications = DB::table('notifications')->where('notifiable_id', 12)->latest()->get();

            foreach ($notifications as $notification) {
                $notificationData = json_decode($notification->data);
                $data[] = [
                    'id' => $notification->id,
                    'obj_id' => $notificationData->viewData->obj_id ?? $notificationData->obj_id ?? null,
                    'title' => $notificationData->title,
                    'body' => $notificationData->body,
                    'type' => $notificationData->viewData->type ?? $notificationData->type ?? null,
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at,
                ];
            }
        } catch (\Exception $ex) {
            return Response::Error($ex->getMessage());
        }
        return Response::Success($data, "success");
    }

    public function checkout()
    {
        try {
            User::find(2)->notify(new SendNotification(1, 'Test Notification',  'Test Notification Test', "Test"));
            return Response::Success(null, "success");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function checkoutApi()
    {
        try {

            $user = User::find(12);
            $push = new PushNotificationController();

            $push->sendPushNotification(
                'Test Notification',
                'Test Notification Test',
                "dbgamhywRBSM3L2IgAxYQK:APA91bGYsJ4yLM1w93r6CJsfAz5wpfvZM_7wcihf_VDUZg6KHzvtsMFjpMhONxV0CMr8ze3xT2scg8-brHv6ZLHX-glcSLlOgAx3ZcLI0LsBzH15OFFDOeE"
            );
            //store notification on database
            Notification::send($user, new StoreNotification(1, 'Test Mobile Notification',  'Test Notification for mobile Test', "Test"));
            return Response::Success(null, "success");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }


    public function markAsRead()
    {
        try {
            $userid = User::find(auth()->user()->id);
            foreach ($userid->unreadNotifications as $notification) {
                $notification->markAsRead();
            }

            return Response::Success(null, 'success');
        } catch (\Exception $ex) {
            return Response::Error($ex->getMessage());
        }
    }

    public function destroy()
    {
        try {
            $notifications = auth()->user()->notifications;

            if (isset($notifications)) {
                foreach ($notifications as $notification) {
                    $notification->delete();
                }
                return Response::Success(null, 'success');
            }
        } catch (\Exception $ex) {
            return Response::Error($ex->getMessage());
        }
    }
}
