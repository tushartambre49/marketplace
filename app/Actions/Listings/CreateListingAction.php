<?php

namespace App\Actions\Listings;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateListingAction
{
    public function execute(array $data, User $provider): Listing
    {
        return DB::transaction(function () use ($data, $provider) {

            return Listing::create([
                'provider_id' => $provider->id,
                'category_id' => $data['category_id'],
                'title'       => $data['title'],
                'description' => $data['description'],
                'city'        => $data['city'],
                'suburb'      => $data['suburb'],
                'price'       => $data['price'],
                'price_type'  => $data['price_type'],
                'status'      => 'pending', // moderation flow
            ]);
        });
    }
}
