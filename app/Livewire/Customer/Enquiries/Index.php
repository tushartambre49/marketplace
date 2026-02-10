<?php
namespace App\Livewire\Customer\Enquiries;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Enquiry;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $enquiries = Enquiry::with([
            'listing',
            'provider',
            'messages.sender'
        ])
        ->where('customer_id', auth()->id())
        ->latest()
        ->paginate(10);


        return view(
            'livewire.customer.enquiries.index',
            compact('enquiries')
        );
    }
}
