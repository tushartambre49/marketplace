<div class="p-6">

    {{-- Header --}}
    <h1 class="text-2xl font-bold mb-6">
        Provider Enquiries Dashboard
    </h1>

    {{-- Filter --}}
    <div class="mb-4">
        <select wire:model.live="status"
                class="border rounded px-3 py-2">

            <option value="">All</option>
            <option value="pending">Pending</option>
            <option value="accepted">Accepted</option>
            <option value="rejected">Rejected</option>

        </select>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full text-left">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Customer</th>
                    <th class="p-3">Listing</th>
                    <th class="p-3">Message</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Date</th>
                </tr>
            </thead>

            <tbody>

                @forelse($enquiries as $enquiry)

                    <tr class="border-t">

                        {{-- Customer --}}
                        <td class="p-3">
                            {{ $enquiry->customer->name }}
                        </td>

                        {{-- Listing --}}
                        <td class="p-3">
                            {{ $enquiry->listing->title }}
                        </td>

                        {{-- Message --}}
                        <td class="p-3">
<livewire:provider.enquiries.reply
    :enquiry="$enquiry"
/>
                        </td>

                        {{-- Status --}}
           <td class="p-3">

    @if($enquiry->status == 'pending')

        <div class="flex items-center gap-2">

            {{-- Accept --}}
            <button
                wire:click="accept({{ $enquiry->id }})"
                wire:loading.attr="disabled"
                class="flex items-center gap-1
                       bg-green-500 hover:bg-green-600
                       text-white text-xs font-semibold
                       px-3 py-1.5 rounded-lg shadow">

                ✔ Accept
            </button>

            {{-- Reject --}}
            <button
                wire:click="reject({{ $enquiry->id }})"
                wire:loading.attr="disabled"
                class="flex items-center gap-1
                       bg-red-500 hover:bg-red-600
                       text-white text-xs font-semibold
                       px-3 py-1.5 rounded-lg shadow">

                ✖ Reject
            </button>

        </div>

    @elseif($enquiry->status == 'accepted')

        <span class="
            inline-flex items-center gap-1
            bg-green-100 text-green-700
            text-xs font-semibold
            px-3 py-1.5 rounded-full">

            ✔ Accepted
        </span>

    @elseif($enquiry->status == 'rejected')

        <span class="
            inline-flex items-center gap-1
            bg-red-100 text-red-700
            text-xs font-semibold
            px-3 py-1.5 rounded-full">

            ✖ Rejected
        </span>

    @endif

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

                            No enquiries received yet.

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $enquiries->links() }}
    </div>

</div>
