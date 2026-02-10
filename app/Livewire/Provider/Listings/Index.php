<?php
namespace App\Livewire\Provider\Listings;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Listing;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $listings = Listing::where(
                'provider_id',
                auth()->id()
            )
            ->latest()
            ->paginate(10);

        return view(
            'livewire.provider.listings.index',
            compact('listings')
        );
    }
    public function delete($id)
    {
        $listing = Listing::findOrFail($id);

        abort_if(
            $listing->provider_id !== auth()->id(),
            403
        );

        $listing->delete();

        session()->flash(
            'success',
            'Listing deleted successfully.'
        );
    }

   


}
