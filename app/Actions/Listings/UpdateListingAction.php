<?php

namespace App\Actions\Listings;

use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class UpdateListingAction
{
    public function execute(Listing $listing, array $data): Listing
    {
        return DB::transaction(function () use ($listing, $data) {

            $listing->update([
                'category_id' => $data['category_id'],
                'title'       => $data['title'],
                'description' => $data['description'],
                'city'        => $data['city'],
                'suburb'      => $data['suburb'],
                'price'       => $data['price'],
                'price_type'  => $data['price_type'],
                'status'      => 'pending', // re-approval needed
            ]);

            return $listing->refresh();
        });
    }
}
