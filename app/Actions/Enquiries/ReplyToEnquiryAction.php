<?php

namespace App\Actions\Enquiries;

use App\Models\Enquiry;
use App\Models\EnquiryMessage;
use App\Models\User;

class ReplyToEnquiryAction
{
    public function execute(
        Enquiry $enquiry,
        User $sender,
        string $message
    ): EnquiryMessage {
        return EnquiryMessage::create([
            'enquiry_id' => $enquiry->id,
            'sender_id'  => $sender->id,
            'message'    => $message,
        ]);
    }
}
