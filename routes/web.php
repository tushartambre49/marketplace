<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Livewire\Listings\SearchListings;
use App\Livewire\Provider\Enquiries\Index as ProviderEnquiriesIndex;
use App\Livewire\Customer\Enquiries\Index as CustomerEnquiriesIndex;

use App\Livewire\Provider\Listings\Index as ProviderListingsIndex;
use App\Livewire\Provider\Listings\Create as ProviderListingsCreate;
use App\Livewire\Provider\Listings\Edit as ProviderListingsEdit;
use App\Livewire\Admin\Listings\Moderation;

Route::middleware(['auth','can:isAdmin'])
    ->get(
        '/admin/listings',
        Moderation::class
    )
    ->name('admin.listings.moderation');
Route::middleware(['auth'])
    ->prefix('provider')
    ->name('provider.')
    ->group(function () {

        Route::get('/listings', ProviderListingsIndex::class)
            ->name('listings.index');

        Route::get('/listings/create', ProviderListingsCreate::class)
            ->name('listings.create');
      
          Route::get('/listings/{listing}/edit',
            \App\Livewire\Provider\Listings\Edit::class
        )->name('listings.edit');

 
        Route::put('/listings/{listing}',
            [ProviderListingsEdit::class,'update'])
            ->name('listings.update');


    });

Route::middleware(['auth'])->group(function () {

    Route::get(
        '/provider/enquiries',
        ProviderEnquiriesIndex::class
    )->name('provider.enquiries.index');

    Route::get(
        '/customer/enquiries',
        CustomerEnquiriesIndex::class
    )->name('customer.enquiries.index');

});


Route::get(
    '/',
    \App\Livewire\Listings\SearchListings::class
)->name('listings.index');



Route::get('/listings/{listing}', function (Listing $listing) {
    return view('listings.show', compact('listing'));
})->name('listings.show');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
