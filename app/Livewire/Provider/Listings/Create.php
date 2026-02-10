<?php
namespace App\Livewire\Provider\Listings;

use Livewire\Component;
use App\Models\Listing;
use App\Models\Category;

class Create extends Component
{
    public $title;
    public $description;
    public $category_id;
    public $city;
    public $suburb;
    public $price;
    public $price_type = 'fixed';

    public function store()
    {
        $this->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
            'city' => 'required',
            'suburb' => 'required',
            'price' => 'required|numeric|min:1',
            'price_type' => 'required|in:fixed,hourly',
        ]);

        Listing::create([
            'provider_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'city' => $this->city,
            'suburb' => $this->suburb,
            'price' => $this->price,
            'price_type' => $this->price_type,

            // 🔑 Default moderation state
            'status' => 'pending',
        ]);

        session()->flash(
            'success',
            'Listing submitted for approval.'
        );

        return redirect()
            ->route('provider.listings.index');
    }

    public function render()
    {
        return view(
            'livewire.provider.listings.create',
            [
                'categories' => Category::all()
            ]
        );
    }
    public function edit(Listing $listing)
    {
        // Owner check
        if ($listing->provider_id !== auth()->id()) {
            abort(403);
        }

      return view(
            'livewire.provider.listings.edit',
            compact('listing')
        );

    }
    public function update(Request $request, Listing $listing)
    {
        if ($listing->provider_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $listing->update([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'status' => 'pending'
        ]);

        return redirect()
            ->route('provider.listings.index')
            ->with('success','Listing updated & sent for approval.');
    }

}
