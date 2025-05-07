<?php

namespace App\Livewire\Demand;

use Flux\Flux;
use App\Models\Demand;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Reject extends Component
{
    public $demandId;
    public $note;

    public function render()
    {
        return view('livewire.demand.reject');
    }

    #[On('demand.reject')]
    public function reject($id)
    {
        $data = Demand::find($id);
        $this->demandId = $data->id;
        Flux::modal('reject-demand')->show();
    }

    public function rejectDemand()
    {
        $this->validate([
            'note' => ['required', 'string', 'max:255'],
        ]);

        $demand = Demand::find($this->demandId);
        $demand->update([
            'status' => 'rejected',
            'note' => $this->note,
            'rejected' => Auth::user()->id
        ]);

        Flux::modal('reject-demand')->close();
        $this->reset(['note']);

        session()->flash('message', 'Demand rejected successfully.');
        $this->dispatch('refresh-demand-list');
    }
}
