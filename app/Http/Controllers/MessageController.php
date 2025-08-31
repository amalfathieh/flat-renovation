<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    // جلب الرسائل في محادثة (قدّم pagination)
    public function index(Request $request, Conversation $conversation)
    {
        $user = Auth::user();

        if (! $this->userCanAccess($user, $conversation)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $messages = $conversation->messages()->with('sender')->latest()->paginate(50);

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
                'sender_type'     => get_class($user->customerProfile),
                'message'         => $data['message'],
            ]);

         //   $m->load('sender');
            event(new \App\Events\Message($data['message'], $sender->name,$sender->admin_id ? 'user' : 'admin' , $sender->id, $receiver->id,$sender->image));
//            broadcast(new
// \App\Events\MessageSent($m))->toOthers();
            event(new \App\Events\MessageSent($m->message,));

            return $m;
        });

        return response()->json($message, 201);
    }


    protected function userCanAccess($user, Conversation $conversation): bool
    {
        if ($user->hasRole('company')) {
            return $user->company && $user->company->id == $conversation->company_id;
        }

        if ($user->customerprofile) {
            return $user->customerProfile->id == $conversation->customer_id;
        }

        return false;
    }
}
