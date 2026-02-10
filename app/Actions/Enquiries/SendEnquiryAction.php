<?php

namespace App\Actions\Enquiries;

use App\Models\Enquiry;
use App\Models\EnquiryMessage;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SendEnquiryAction
{
    public function execute(
        Listing $listing,
        User $customer,
        string $message
    ): Enquiry {
        return DB::transaction(function () use ($listing, $customer, $message) {

            $enquiry = Enquiry::firstOrCreate([
                'listing_id'  => $listing->id,
                'customer_id' => $customer->id,
                'provider_id' => $listing->provider_id,
            ]);

            EnquiryMessage::create([
                'enquiry_id' => $enquiry->id,
                'sender_id'  => $customer->id,
                'message'    => $message,
            ]);

            return $enquiry;
        });
    }
}
