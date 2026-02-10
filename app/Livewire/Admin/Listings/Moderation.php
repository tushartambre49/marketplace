<?php

namespace App\Livewire\Admin\Listings;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Listing;

class Moderation extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $statusFilter = 'pending';
    



    public function suspend($id)
    {
        $listing = Listing::findOrFail($id);

        $listing->update([
            'status' => 'suspended'
        ]);
    }

    public function approve($id)
    {
        $listing = Listing::findOrFail($id);

        $listing->update([
            'status' => 'approved'
        ]);
    }
    public function reinstate($id)
    {
        $listing = Listing::findOrFail($id);

        $listing->update([
            'status' => 'approved'
        ]);
    }


    public function render()
    {
     
        $listings = Listing::with('provider')
            ->where('status', $this->statusFilter)
            ->latest()
            ->paginate(10);

        return view(
            'livewire.admin.listings.moderation',
            compact('listings')
        );
    }

}
