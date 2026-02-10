<?php
namespace App\Livewire\Provider\Enquiries;

use Livewire\Component;
use App\Models\Enquiry;
use App\Models\EnquiryMessage;

class Reply extends Component
{
    public Enquiry $enquiry;

    public $message = '';

    protected $rules = [
        'message' => 'required|min:2',
    ];

    public function sendReply()
    {
        $this->validate();

        EnquiryMessage::create([
            'enquiry_id' => $this->enquiry->id,
            'sender_id' => auth()->id(),
            'message' => $this->message,
        ]);

        $this->reset('message');
    }

    public function render()
    {
        $messages = $this->enquiry
            ->messages()
            ->with('sender')
            ->latest()
            ->get();

        return view(
            'livewire.provider.enquiries.reply',
            compact('messages')
        );
    }
}
