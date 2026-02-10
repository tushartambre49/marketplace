<?php
namespace App\Livewire\Provider\Listings;

use Livewire\Component;
use App\Models\Listing;

class Edit extends Component
{
    public $listing;
    public $title;
    public $price;
    public $description;

    public function mount(Listing $listing)
    {
        abort_if(
            $listing->provider_id !== auth()->id(),
            403
        );

        $this->listing = $listing;
        $this->title = $listing->title;
        $this->price = $listing->price;
        $this->description = $listing->description;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $this->listing->update([
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'status' => 'pending',
        ]);

        session()->flash(
            'success',
            'Listing updated & sent for approval.'
        );

        return redirect()
            ->route('provider.listings.index');
    }

    public function render()
    {
        return view(
            'livewire.provider.listings.edit'
        );
    }
}
