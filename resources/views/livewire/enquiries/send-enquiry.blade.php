<div>


    {{-- BUTTON --}}
    @auth
        @if(auth()->user()->isCustomer())

            <button
                wire:click="openForm"
                class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-xl shadow">
                Send Enquiry
            </button>

        @endif
    @endauth


    {{-- SUCCESS MESSAGE --}}
    @if (session()->has('success'))
        <div class="mt-4 text-green-600 font-semibold">
            {{ session('success') }}
        </div>
    @endif


    {{-- POPUP FORM --}}
    @if($showForm)

        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

            <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-lg">

                <h2 class="text-xl font-bold mb-4 text-pink-600">
                    Send Enquiry
                </h2>
                @if(session()->has('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
                        {{ session('error') }}
                    </div>
                @endif

                <textarea
                    wire:model="message"
                    rows="5"
                    placeholder="Write your enquiry..."
                    class="w-full border-2 border-pink-200 rounded-xl p-3 focus:border-pink-500"></textarea>

                @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror


                <div class="flex justify-end gap-3 mt-4">

                    <button
                        wire:click="$set('showForm', false)"
                        class="px-4 py-2 bg-gray-300 rounded-lg">
                        Cancel
                    </button>

                    <button
                        wire:click="send"
                        class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600">
                        Send
                    </button>

                </div>

            </div>

        </div>

    @endif

</div>
