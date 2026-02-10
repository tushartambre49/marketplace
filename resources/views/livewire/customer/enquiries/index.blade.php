<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">
        My Enquiries
    </h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full text-left">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Listing</th>
                    <th class="p-3">Provider</th>
                    <th class="p-3">Message</th>
                    <th class="p-3">Provider Reply</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Date</th>
                </tr>
            </thead>

            <tbody>

                @forelse($enquiries as $enquiry)

                    <tr class="border-t">

                        {{-- Listing --}}
                        <td class="p-3">
                            {{ $enquiry->listing->title }}
                        </td>

                        {{-- Provider --}}
                        <td class="p-3">
                            {{ $enquiry->provider->name }}
                        </td>

                        {{-- Message --}}
                        <td class="p-3">
                            {{ Str::limit($enquiry->message, 50) }}
                        </td>
<td class="p-3">

    <div class="border rounded-lg p-3 bg-gray-50">

        <h3 class="font-semibold mb-2">
            Conversation
        </h3>

        <div class="space-y-2">

            @foreach($enquiry->messages as $msg)

                <div class="
                    p-2 rounded text-sm
                    @if($msg->sender_id == auth()->id())
                        bg-blue-100 text-right
                    @else
                        bg-gray-200
                    @endif
                ">

                    <strong>
                        {{ $msg->sender->name }}
                    </strong>

                    <div>
                        {{ $msg->message }}
                    </div>

                </div>

            @endforeach

        </div>

    </div>

</td>

                        {{-- Status --}}
                        <td class="p-3">

                            <span class="
                                px-3 py-1 rounded-full text-xs font-semibold
                                @if($enquiry->status=='pending') bg-yellow-100 text-yellow-700 @endif
                                @if($enquiry->status=='accepted') bg-green-100 text-green-700 @endif
                                @if($enquiry->status=='rejected') bg-red-100 text-red-700 @endif
                            ">
                                {{ ucfirst($enquiry->status) }}
                            </span>

                        </td>

                        {{-- Date --}}
                        <td class="p-3">
                            {{ $enquiry->created_at->format('d M Y') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5"
                            class="p-6 text-center text-gray-500">

                            No enquiries sent yet.

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-4">
        {{ $enquiries->links() }}
    </div>

</div>
