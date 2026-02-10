<?php

namespace App\Actions\Listings;

use App\Models\Listing;

class SearchListingsAction
{
    public function execute(array $filters)
{
  

    $query = Listing::query()
        ->where('status','approved')
        ->with(['provider','category']);

    // Keyword
   if (!empty($filters['keyword'])) {
    $query->where(function ($q) use ($filters) {
        $q->where('title', 'like',
                '%' . $filters['keyword'] . '%')
          ->orWhere('description', 'like',
                '%' . $filters['keyword'] . '%');
    });
}


    // Category
    if (!empty($filters['category_id'])) {
        $query->where(
            'category_id',
            $filters['category_id']
        );
    }

    // City
    if (!empty($filters['city'])) {
        $query->where(
            'city',
            'like',
            '%' . $filters['city'] . '%'
        );
    }

    // Price
    if (!empty($filters['price_min'])) {
        $query->where('price','>=',$filters['price_min']);
    }

    if (!empty($filters['price_max'])) {
        $query->where('price','<=',$filters['price_max']);
    }

    // Sorting
    switch ($filters['sort'] ?? null) {
        case 'price_low':
            $query->orderBy('price','asc');
            break;
        case 'price_high':
            $query->orderBy('price','desc');
            break;
        default:
            $query->latest();
    }

    return $query->paginate(10);
}

}
