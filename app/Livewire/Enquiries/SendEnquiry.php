<?php

namespace App\Livewire\Enquiries;

use Livewire\Component;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Auth;

class SendEnquiry extends Component
{
    public $listing;
    public $message = '';
    public $showForm = false;

    protected $rules = [
        'message' => 'required|min:10',
    ];

    public function openForm()
    {
        $this->showForm = true;
    }

    public function send()
    {
        $this->validate();
        $exists = Enquiry::where([
            'listing_id' => $this->listing->id,
            'customer_id' => auth()->id(),
            'provider_id' => $this->listing->provider_id,
        ])->exists();

        if ($exists) {
            session()->flash(
                'error',
                'You already sent enquiry for this listing.'
            );
            return;
        }

        Enquiry::create([
            'listing_id' => $this->listing->id,
            'customer_id' => Auth::id(),
            'provider_id' => $this->listing->provider_id,
            'message' => $this->message,
        ]);

        $this->reset('message');
        $this->showForm = false;

        session()->flash('success', 'Enquiry sent successfully!');
    }

    public function render()
    {
        return view('livewire.enquiries.send-enquiry');
    }
}
