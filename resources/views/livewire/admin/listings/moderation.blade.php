<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">
        Listings Moderation
    </h1>

    {{-- Filter --}}
    <div class="mb-4">
        <select wire:model.live="statusFilter"
                class="border p-2 rounded">

            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="suspended">Suspended</option>

        </select>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded">

        <table class="w-full">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Title</th>
                    <th>Provider</th>
                    <th>City</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($listings as $listing)


                    <tr class="border-t">

                        <td class="p-3">
                            {{ $listing->title }}
                        </td>

                        <td>
                            {{ $listing->provider->name }}
                        </td>

                        <td>
                            {{ $listing->city }}
                        </td>

                        <td>
                            ₹{{ $listing->price }}
                        </td>

                        <td>

                            @if($listing->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-sm">
                                    Pending
                                </span>
                            @elseif($listing->status === 'approved')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">
                                    Approved
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">
                                    Suspended
                                </span>
                            @endif

                        </td>

<td class="space-x-2">

{{-- PENDING --}}
@if($listing->status === 'pending')


    <button
        wire:click="approve({{ $listing->id }})"
        class="bg-green-600 text-white px-3 py-1 rounded">
        Approved
    </button>

    <button
        wire:click="suspend({{ $listing->id }})"
        class="bg-red-600 text-white px-3 py-1 rounded">
        Suspend
    </button>

@endif

{{-- APPROVED --}}
@if($listing->status === 'approved')

    <button
        wire:click="suspend({{ $listing->id }})"
        class="bg-red-600 text-white px-3 py-1 rounded">
        Suspend
    </button>

@endif

{{-- SUSPENDED --}}
@if($listing->status === 'suspended')

    <button
        wire:click="reinstate({{ $listing->id }})"
        class="bg-blue-600 text-white px-3 py-1 rounded">
        Reinstate
    </button>

@endif

</td>





                    </tr>

                @empty

                    <tr>
                        <td colspan="6"
                            class="text-center p-6 text-gray-500">
                            No listings found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-4">
        {{ $listings->links() }}
    </div>

</div>
