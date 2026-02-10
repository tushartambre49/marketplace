<div class="max-w-7xl mx-auto p-6">

    {{-- ============== FILTER BOX ============== --}}
    <div class="grid md:grid-cols-5 gap-4">

    <input type="text"
           wire:model="keyword"
           placeholder="Search services..."
           class="border-2 border-pink-200 rounded-xl p-2">

    <select wire:model="category_id"
            class="border-2 border-pink-200 rounded-xl p-2">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <input type="text"
           wire:model="city"
           placeholder="City"
           class="border-2 border-pink-200 rounded-xl p-2">

    <select wire:model="sort"
            class="border-2 border-pink-200 rounded-xl p-2">
        <option value="newest">Newest</option>
        <option value="price_low">Price Low → High</option>
        <option value="price_high">Price High → Low</option>
    </select>

    {{-- 🔍 SEARCH BUTTON --}}
    <button
        wire:click="$refresh"
        class="bg-pink-500 text-white rounded-xl px-4 py-2">
        Search
    </button>
<button
    wire:click="resetFilters"
    class="bg-gray-400 text-white px-4 py-2 rounded-xl">
    Clear
</button>

</div>



    {{-- ============== LOADING ============== --}}
    <div wire:loading class="text-pink-600 font-semibold mb-4">
        Loading services...
    </div>


    {{-- ============== LISTINGS GRID ============== --}}
    <div class="grid md:grid-cols-3 gap-8">

        @forelse($listings as $listing)

            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-100">

                <div class="p-5">

                    <h3 class="text-lg font-bold text-gray-800 mb-1">
                        {{ $listing->title }}
                    </h3>

                    <p class="text-sm text-pink-500 font-medium">
                        {{ $listing->category->name }}
                    </p>

                    <p class="text-sm text-gray-500">
                        📍 {{ $listing->city }}, {{ $listing->suburb }}
                    </p>

                    <p class="text-xl font-bold text-pink-600 mt-3">
                        ${{ number_format($listing->price, 2) }}
                        <span class="text-sm text-gray-500">
                            ({{ ucfirst($listing->price_type) }})
                        </span>
                    </p>

                    <a href="{{ route('listings.show', $listing) }}"
                       class="block text-center mt-4 bg-pink-500 hover:bg-pink-600 text-white py-2 rounded-xl transition">
                        View Details
                    </a>

                </div>

            </div>

        @empty

            <div class="col-span-3 text-center py-20">

                <p class="text-gray-400 text-lg">
                    No listings found matching your criteria.
                </p>

            </div>

        @endforelse

    </div>


    {{-- ============== PAGINATION ============== --}}
    <div class="mt-10">
        {{ $listings->links() }}
    </div>

</div>
