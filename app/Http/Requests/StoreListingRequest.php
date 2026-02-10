<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only providers can create listings
        return auth()->user()?->isProvider();
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
                'min:20',
            ],

            'city' => [
                'required',
                'string',
                'max:100',
            ],

            'suburb' => [
                'required',
                'string',
                'max:100',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'price_type' => [
                'required',
                'in:hourly,fixed',
            ],
        ];
    }
}
