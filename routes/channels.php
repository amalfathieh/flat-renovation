<?php
//
//use Illuminate\Support\Facades\Broadcast;

//Broadcast::channel('chat.{conversationId}', function ($user, $conversationId) {
//    return true;
//});
//Broadcast::channel('chat.{conversationId}', function ($user, $conversationId) {
//    $conversation = \App\Models\Conversation::find($conversationId);
//
//    if (! $conversation) {
//        return false;
//    }
//
//
//    return ($user->hasRole('company') && $user->company && $user->company->id == $conversation->company_id)
//        || ($user->customerProfile && $user->customerProfile->id == $conversation->customer_id);
//});
//
//use Illuminate\Support\Facades\Broadcast;
//
//Broadcast::channel('conversation.{sender}.{receiver}', function ($user, $sender, $receiver) {
//    // لازم تحدد الشرط اللي يسمح للمستخدم يسمع بهالقناة
//    return true; // جرب مبدئياً
//});
