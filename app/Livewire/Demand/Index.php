<?php

namespace App\Livewire\Demand;

use App\Models\Demand;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    protected $queryString = ['search', 'status'];
    public $note = '';


    #[On('refresh-demand-list')]
    public function render()
    {
        $query = Demand::with('demandItems', 'user')
            ->where(function($q) {
                $q->where('demand_number', 'like', '%' . $this->search . '%')
                  ->orWhere('regarding', 'like', '%' . $this->search . '%')
                  ->orWhere('demand_date', 'like', '%' . $this->search . '%');
            });

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $data = $query->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.demand.index', compact('data'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function processedDemand($demandId)
    {

        $demand = Demand::findOrFail($demandId);
        
        $demand->update([
           'status' => 'processed',
           'processed' => Auth::user()->id
        ]);
        $this->dispatch('refresh-demand-list');
        session()->flash('message', 'Demand has been processed successfully.');
    }

    public function approvedDemand($demandId)
    {
        $demand = Demand::findOrFail($demandId);
        $demand->update([
            'status' => 'approved',
            'approved' => Auth::user()->id
        ]);

        $this->dispatch('refresh-demand-list');
        session()->flash('message', 'Demand has been approved successfully.');
    }

    public function rejectedDemand($demandId)
    {
       
        $demand = Demand::findOrFail($demandId);
        $demand->update([
            'status' => 'rejected',
            'rejected' => Auth::user()->id,
            'note' => $this->note
        ]);

        $this->dispatch('refresh-demand-list');
        session()->flash('message', 'Demand has been rejected successfully.');
    }

    public function generatePDF($demandId)
    {
        return redirect()->route('demand.pdf', ['demand' => $demandId]);
    }

    public function delete($id)
    {
       $this->dispatch('demand.delete', $id);
    }
}
