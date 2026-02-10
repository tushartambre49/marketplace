<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only customers can send enquiries
        return auth()->user()?->isCustomer();
    }

    public function rules(): array
    {
        return [
            'message' => [
                'required',
                'string',
                'min:10',
                'max:2000',
            ],
        ];
    }
}
