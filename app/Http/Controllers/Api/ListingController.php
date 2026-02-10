<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use App\Http\Controllers\Controller;
use App\Actions\Listings\CreateListingAction;
use App\Http\Requests\StoreListingRequest;

class ListingController extends Controller
{
    public function store(
        StoreListingRequest $request,
        CreateListingAction $action
    ) {
        $listing = $action->execute(
            $request->validated(),
            auth()->user()
        );

        return response()->json($listing, 201);
    }

    public function show(Listing $listing)
    {
        return response()->json(
            $listing->load('provider', 'category')
        );
    }

    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);

        $listing->delete();

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
