<div class="flex h-[600px] border rounded overflow-hidden">
    <!-- قائمة المحادثات -->
    <div class="w-1/3 border-r overflow-auto">
        @foreach($conversations as $conv)
            <div class="p-3 cursor-pointer hover:bg-gray-50 {{ $selectedConversationId == $conv->id ? 'bg-gray-100' : '' }}"
                 wire:click="selectConversation({{ $conv->id }})">
                {{ $conv->title ?? 'محادثة #' . $conv->id }}
            </div>
        @endforeach
    </div>

    <!-- الرسائل -->
    <div class="w-2/3 flex flex-col">
        <div id="messagesBox" wire:ignore class="flex-1 overflow-auto p-4">
            @foreach($messages as $m)
                <div class="mb-3 text-sm {{ $m['sender']['id'] == auth()->id() ? 'text-right' : 'text-left' }}">
                    <div class="font-bold">{{ $m['sender']['name'] }}</div>
                    <div>{{ $m['message'] }}</div>
                    <div class="text-xs text-gray-400">{{ $m['created_at'] }}</div>
                </div>
            @endforeach
        </div>

        <div class="p-3 border-t">
            <form wire:submit.prevent="sendMessage" class="flex gap-2">
                <input wire:model.defer="newMessage" type="text" placeholder="اكتب رسالة..."
                       class="flex-1 p-2 border rounded">
                <button type="submit" class="btn btn-primary">إرسال</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {

        function scrollToBottom() {
            const box = document.getElementById('messagesBox');
            if (box) {
                requestAnimationFrame(() => {
                    box.scrollTop = box.scrollHeight;
                });
            }
        }

        // Scroll عند حدث Livewire
        window.addEventListener('scroll-to-bottom', scrollToBottom);

        // تسجيل قناة المحادثة عبر Echo
        window.addEventListener('registerConversationChannel', (event) => {
            const senderId = event.detail.senderId;
            const receiverId = event.detail.receiverId;
            const minId = Math.min(senderId, receiverId);
            const maxId = Math.max(senderId, receiverId);

            if (window.Echo) {
                window.Echo.private(`conversation.${minId}.${maxId}`)
                    .listen('.Message', (e) => {
                        Livewire.emit('incomingMessage', e);
                        scrollToBottom();
                    });
            }
        });

        // Scroll عند أي تحديث Livewire
        Livewire.hook('message.processed', (message, component) => {
            scrollToBottom();
        });

    });
</script>
