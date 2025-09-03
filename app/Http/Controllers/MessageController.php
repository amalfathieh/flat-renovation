<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Beste\Cache\get;

class MessageController extends Controller
{

    public function index(Request $request, Conversation $conversation)
    {
        $user = Auth::user();

        if (! $this->userCanAccess($user, $conversation))
            return response()->json(['message' => 'Forbidden'], 403);


        $messages = $conversation->messages()->get();

        return response()->json($messages);

    }

    public function store(Request $request, Conversation $conversation)
    {
        $user = Auth::user();

        if (! $user->customerProfile) {
            return response()->json(['message' => 'Only customers can send messages'], 403);
        }

        if ($conversation->customer_id !== $user->customerProfile->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'message' => 'required|string',
        ]);

        $message = DB::transaction(function () use ($conversation, $user, $data) {
            $m = Message::create([
                'conversation_id' => $conversation->id,
                'sender_id'       => $user->customerProfile->id,
                'sender_type'     => $user->customerProfile->type,
                'sender_name'     => $user->name,
                'message'         => $data['message'],
                'sender_image'    => $user->customerProfile->image,
            ]);

//            event(new \App\Events\Messagesent(
//                $m->message,
//                $user->customerProfile->id,
//                $user->name,
//                $user->customerProfile->type,
//                $conversation->employee_id,
//                $user->customerProfile->image
//            ));
            event(new \App\Events\MessageSent(
                $m->message,                  // نص الرسالة
                $user->name,                   // senderName
                $user->customerProfile->type,  // senderType
                $user->customerProfile->id,    // senderId
                $conversation->employee_id,    // receiverId
                $user->customerProfile->image  // senderImage
            ));


            return $m;
        });


        return response()->json([
            'message' => 'Message sent successfully',
            'data'    => $message,
        ], 201);
    }


        protected function userCanAccess($user, Conversation $conversation): bool
    {
        if ($user->company) {
            return $user->company && $user->company->id == $conversation->company_id;
        }

        if ($user->customerProfile) {
            return $user->customerProfile->id == $conversation->customer_id;
        }

        return false;
    }
}
