<div class="p-6">

    <div class="flex justify-between mb-4">
         @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400
                    text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
        <h1 class="text-xl font-bold">
            My Listings
        </h1>

        <a href="{{ route('provider.listings.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Add Listing
        </a>
    </div>

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="border-b">
                <th class="p-3 text-left">Title</th>
                <th>Status</th>
                <th>Price</th>
                <th>Date</th>
                <th class="text-center">Actions</th> {{-- NEW --}}
            </tr>
        </thead>

        <tbody>
            @forelse($listings as $listing)
                <tr class="border-b">

                    <td class="p-3">
                        {{ $listing->title }}
                    </td>

                    <td>
                        {{ ucfirst($listing->status) }}
                    </td>

                    <td>
                        ₹{{ $listing->price }}
                    </td>

                    <td>
                        {{ $listing->created_at->format('d M Y') }}
                    </td>

                    {{-- ACTIONS --}}
                    <td class="text-center space-x-2">

                        {{-- EDIT --}}
                        <a href="{{ route('provider.listings.edit', $listing->id) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <button
                            wire:click="delete({{ $listing->id }})"
                            onclick="confirm('Delete this listing?') || event.stopImmediatePropagation()"
                            class="bg-red-600 text-white px-3 py-1 rounded">
                            Delete
                        </button>

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5"
                        class="p-4 text-center text-gray-500">
                        No listings yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
