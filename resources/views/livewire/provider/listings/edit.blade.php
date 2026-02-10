<div class="p-6 max-w-xl">

    <h1 class="text-xl font-bold mb-4">
        Edit Listing
    </h1>

    <form wire:submit.prevent="update">

        <input type="text"
               wire:model="title"
               class="w-full border p-2 mb-3">

        <input type="number"
               wire:model="price"
               class="w-full border p-2 mb-3">

        <textarea wire:model="description"
                  class="w-full border p-2 mb-3"></textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update Listing
        </button>

    </form>

</div>
