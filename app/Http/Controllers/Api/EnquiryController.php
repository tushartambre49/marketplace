<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use App\Models\Enquiry;
use App\Http\Controllers\Controller;
use App\Actions\Enquiries\SendEnquiryAction;
use App\Actions\Enquiries\ReplyToEnquiryAction;
use App\Http\Requests\SendEnquiryRequest;

class EnquiryController extends Controller
{
    public function store(
        SendEnquiryRequest $request,
        Listing $listing,
        SendEnquiryAction $action
    ) {
        $enquiry = $action->execute(
            $listing,
            auth()->user(),
            $request->message
        );

        return response()->json($enquiry, 201);
    }

    public function reply(
        SendEnquiryRequest $request,
        Enquiry $enquiry,
        ReplyToEnquiryAction $action
    ) {
        $message = $action->execute(
            $enquiry,
            auth()->user(),
            $request->message
        );

        return response()->json($message);
    }
}
