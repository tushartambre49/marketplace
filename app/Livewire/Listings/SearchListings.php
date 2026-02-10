<?php

namespace App\Livewire\Listings;

use Livewire\Component;
use Livewire\WithPagination;
use App\Actions\Listings\SearchListingsAction;
use App\Models\Category;

class SearchListings extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $keyword = '';
    public $category_id = '';
    public $city = '';
    public $suburb = '';
    public $price_min = '';
    public $price_max = '';
    public $sort = 'newest';

    protected $queryString = [
        'keyword',
        'category_id',
        'city',
        'price_min',
        'price_max',
        'sort',
    ];

    public function updating()
    {
        $this->resetPage();
    }

   public function render()
{
    $action = app(\App\Actions\Listings\SearchListingsAction::class);

    $filters = [
        'keyword' => $this->keyword,
        'category_id' => $this->category_id,
        'city' => $this->city,
        'suburb' => $this->suburb,
        'price_min' => $this->price_min,
        'price_max' => $this->price_max,
        'sort' => $this->sort,
    ];

    return view('livewire.listings.search-listings', [
        'listings' => $action->execute($filters),
        'categories' => \App\Models\Category::all(),
    ])->layout('layouts.app');
}
public function resetFilters()
{
    $this->reset([
        'keyword',
        'category_id',
        'city',
        'price_min',
        'price_max',
        'sort',
    ]);
}

}
