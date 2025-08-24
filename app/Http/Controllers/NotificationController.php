<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use App\Models\User;
use App\Notifications\SendNotification;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        try {
            $data = [];
            $notifications = DB::table('notifications')->where('notifiable_id', 2)->latest()->get();

            foreach ($notifications as $notification) {
                $notificationData = json_decode($notification->data);
                $data[] = [
                    'id' => $notification->id,
                    'obj_id' => $notificationData->viewData->obj_id ?? null,
                    'title' => $notificationData->title,
                    'body' => $notificationData->body,
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
            $data = [
                'obj_id' => 1,
                'title' => 'Test Notification',
                'body' => 'Test Notification Test',
            ];

            User::find(2)->notify(new SendNotification($data));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }


    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->findOrFail($notificationId);

        if (isset($notification)) {
            $notification->markAsRead();
            return Response::Success(null, 'success');
        }
        return Response::Error('not Found', 404);
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        if (isset($notification)) {
            $notification->delete();
            return Response::Success(null, 'success');
        }
        return Response::Error('not Found', 404);
    }
}
