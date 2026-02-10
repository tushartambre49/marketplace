<?php
namespace App\Livewire\Provider\Enquiries;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Enquiry;
   

class Index extends Component
{
    use WithPagination;

    public $status = '';

    protected $paginationTheme = 'tailwind';

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Enquiry::query()
            ->with(['listing', 'customer'])
            ->where(
                'provider_id',
                auth()->id()
            )
            ->latest();

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $enquiries = $query->paginate(10);

        return view(
            'livewire.provider.enquiries.index',
            compact('enquiries')
        );
    }

    public function accept($id)
    {
        Enquiry::where('id', $id)
            ->where('provider_id', auth()->id())
            ->update([
                'status' => 'accepted'
            ]);
    }

    public function reject($id)
    {
        Enquiry::where('id', $id)
            ->where('provider_id', auth()->id())
            ->update([
                'status' => 'rejected'
            ]);
    }

}
