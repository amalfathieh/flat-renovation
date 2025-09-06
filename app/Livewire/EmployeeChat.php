<?php

//namespace App\Livewire;
//
//use Livewire\Component;
//use App\Models\Conversation;
//use App\Models\Message;
//use Illuminate\Support\Facades\Auth;
//
//class EmployeeChat extends Component
//{
//    public $conversations = [];
//    public $messages = [];
//    public $selectedConversationId;
//    public $newMessage = '';
//
//    public function mount()
//    {
//        $this->conversations = Conversation::with('messages')
//            ->where('employee_id', Auth::id())
//            ->get();
//    }
//
//    public function selectConversation($conversationId)
//    {
//        $this->selectedConversationId = $conversationId;
//
//        $conversation = Conversation::with('messages.sender')->find($conversationId);
//        if (!$conversation) return;
//
//        $this->messages = $conversation->messages->map(function ($msg) {
//            return [
//                'id' => $msg->id,
//                'message' => $msg->message,
//                'created_at' => $msg->created_at->toDateTimeString(),
//                'sender' => [
//                    'id' => $msg->sender_id,
//                    'name' => $msg->sender_name,
//                ],
//            ];
//        })->toArray();
//
//        $this->dispatchBrowserEvent('registerConversationChannel', [
//            'senderId' => Auth::id(),
//            'receiverId' => $conversation->customer_id,
//        ]);
//    }
//
//    public function sendMessage()
//    {
//        try {
//            $user = Auth::user();
//            if (!$user) return;
//
//            $conversation = Conversation::find($this->selectedConversationId);
//            if (!$conversation) return;
//
//            $msgText = trim($this->newMessage);
//            if ($msgText === '') return;
//
//            $message = Message::create([
//                'conversation_id' => $conversation->id,
//                'sender_id' => $user->id,
//                'sender_type' => 'employee',
//                'sender_name' => $user->name,
//                'message' => $msgText,
//            ]);
//
//            $this->messages[] = [
//                'id' => $message->id,
//                'message' => $message->message,
//                'created_at' => $message->created_at->toDateTimeString(),
//                'sender' => [
//                    'id' => $message->sender_id,
//                    'name' => $message->sender_name,
//                ],
//            ];
//
//            $this->newMessage = '';
//
//            // بث الرسالة بأمان
//            if (class_exists(\App\Events\MessageSent::class)) {
//                try {
//                    event(new \App\Events\MessageSent(
//                        $message->message,
//                        $user->name,
//                        'employee',
//                        $user->id,
//                        $conversation->customer_id,
//                        null
//                    ))->toOthers();
//                } catch (\Exception $e) {
//                    \Log::error("Broadcast failed: " . $e->getMessage());
//                }
//            }
//
//            $this->dispatchBrowserEvent('scroll-to-bottom');
//
//        } catch (\Exception $e) {
//            \Log::error("sendMessage error: " . $e->getMessage());
//        }
//    }
//
//    public function incomingMessage($data)
//    {
//        $this->messages[] = [
//            'id' => $data['id'] ?? null,
//            'message' => $data['message'],
//            'created_at' => now()->toDateTimeString(),
//            'sender' => [
//                'id' => $data['senderId'],
//                'name' => $data['senderName'],
//            ],
//        ];
//
//        $this->dispatchBrowserEvent('scroll-to-bottom');
//    }
//
//    public function render()
//    {
//        return view('livewire.employee-chat');
//    }
//}
