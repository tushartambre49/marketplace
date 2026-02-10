<div class="p-4 border rounded-lg bg-white">

    <h2 class="font-semibold mb-3">
        Conversation
    </h2>

    {{-- Messages --}}
    <div class="space-y-2 mb-4 max-h-64 overflow-y-auto">

        @foreach($messages as $msg)

            <div class="
                p-2 rounded text-sm
                @if($msg->sender_id == auth()->id())
                    bg-blue-100 text-right
                @else
                    bg-gray-100
                @endif
            ">

                <strong>
                    {{ $msg->sender->name }}
                </strong>

                <div>{{ $msg->message }}</div>

            </div>

        @endforeach

    </div>

    {{-- Reply Box --}}
    <form wire:submit.prevent="sendReply"
          class="flex gap-2">

        <input
            type="text"
            wire:model="message"
            placeholder="Type reply..."
            class="flex-1 border rounded px-3 py-2">

        <button
            class="bg-blue-500 text-white px-4 py-2 rounded">

            Send
        </button>

    </form>

</div>
