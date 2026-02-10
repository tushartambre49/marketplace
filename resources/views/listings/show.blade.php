@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white shadow-xl rounded-2xl p-8">

        {{-- Title --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            {{ $listing->title }}
        </h1>

        {{-- Category --}}
        <p class="text-pink-500 font-semibold mb-2">
            {{ $listing->category->name }}
        </p>

        {{-- Location --}}
        <p class="text-gray-500 mb-4">
            📍 {{ $listing->city }}, {{ $listing->suburb }}
        </p>

        {{-- Price --}}
        <p class="text-2xl font-bold text-pink-600 mb-6">
            ${{ number_format($listing->price, 2) }}
            <span class="text-sm text-gray-500">
                ({{ ucfirst($listing->price_type) }})
            </span>
        </p>

        {{-- Description --}}
        <div class="text-gray-700 leading-relaxed mb-8">
            {{ $listing->description }}
        </div>

        {{-- Provider Info --}}
        <div class="bg-gray-50 border rounded-xl p-4 mb-6">
            <h3 class="font-semibold text-gray-700">
                Service Provider
            </h3>

            <p class="text-gray-600">
                {{ $listing->provider->name }}
            </p>
        </div>

        {{-- CTA --}}
        @auth
            @if(auth()->user()->isCustomer())

                     <livewire:enquiries.send-enquiry :listing="$listing" />


            @endif
        @else

            <a href="{{ route('login') }}"
               class="bg-gray-800 text-white px-6 py-3 rounded-xl">
                Login to Contact
            </a>

        @endauth

    </div>

</div>

@endsection
