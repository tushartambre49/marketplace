<div class="p-6 max-w-3xl">

    <h1 class="text-xl font-bold mb-4">
        Add Listing
    </h1>
    @if ($errors->any())
    <div class="bg-red-100 p-3 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    @if (session()->has('success'))
        <div class="bg-green-100 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="store"
          class="space-y-4 bg-white p-6 rounded shadow">

        {{-- Title --}}
        <div>
            <label class="block mb-1">Title</label>
            <input type="text"
                   wire:model="title"
                   class="w-full border p-2 rounded">

            @error('title')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label>Description</label>
            <textarea wire:model="description"
                      class="w-full border p-2 rounded"></textarea>
        </div>

        {{-- Category --}}
        <div>
            <label>Category</label>
            <select wire:model="category_id"
                    class="w-full border p-2 rounded">
                <option value="">Select</option>

                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- City --}}
        <div>
            <label>City</label>
            <input type="text"
                   wire:model="city"
                   class="w-full border p-2 rounded">
        </div>

        {{-- Suburb --}}
        <div>
            <label>Suburb</label>
            <input type="text"
                   wire:model="suburb"
                   class="w-full border p-2 rounded">
        </div>

        {{-- Price --}}
        <div>
            <label>Price</label>
            <input type="number"
                   wire:model="price"
                   class="w-full border p-2 rounded">
        </div>

        {{-- Price Type --}}
        <div>
            <label>Pricing Type</label>

            <select wire:model="price_type"
                    class="w-full border p-2 rounded">
                <option value="fixed">Fixed</option>
                <option value="hourly">Hourly</option>
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Submit Listing
        </button>

    </form>

</div>
