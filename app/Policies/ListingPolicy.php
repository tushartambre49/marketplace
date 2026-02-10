<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;

class ListingPolicy
{
    /**
     * Determine whether the user can view any listings.
     * (Providers see their own, Admin sees all)
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isProvider();
    }

    /**
     * Determine whether the user can view a specific listing.
     */
    public function view(?User $user, Listing $listing): bool
    {
        // Public can see approved listings
        if ($listing->status === 'approved') {
            return true;
        }

        // Admin can see all
        if ($user && $user->isAdmin()) {
            return true;
        }

        // Provider can see their own listing
        if ($user && $user->id === $listing->provider_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create listings.
     */
    public function create(User $user): bool
    {
        return $user->isProvider();
    }

    /**
     * Determine whether the user can update the listing.
     */
    public function update(User $user, Listing $listing): bool
    {
        return $user->isProvider()
            && $user->id === $listing->provider_id;
    }

    /**
     * Determine whether the user can delete the listing.
     */
    public function delete(User $user, Listing $listing): bool
    {
        return $user->isProvider()
            && $user->id === $listing->provider_id;
    }

    /**
     * Admin can restore suspended listings.
     */
    public function restore(User $user, Listing $listing): bool
    {
        return $user->isAdmin();
    }

    /**
     * Permanent delete — Admin only.
     */
    public function forceDelete(User $user, Listing $listing): bool
    {
        return $user->isAdmin();
    }

    /**
     * Approve listing (custom moderation action)
     */
    public function approve(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Suspend listing (custom moderation action)
     */
    public function suspend(User $user): bool
    {
        return $user->isAdmin();
    }
}
