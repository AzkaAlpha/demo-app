<?php

namespace App\Livewire\Demand;

use Flux\Flux;
use App\Models\Demand;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Delete extends Component
{
    public $demandId;

    public function render()
    {
        return view('livewire.demand.delete');
    }

    #[On('demand.delete')]
    public function delete($id)
    {
     
        $data = Demand::find($id);
        $this->demandId = $data->id;
        Flux::modal('delete-demand')->show();
    }

    public function destroy()
    {
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to delete a demand.');
            return;
        }

        try {
            DB::beginTransaction();
            
            $demand = Demand::find($this->demandId);
            
            // Delete demand items first
            $demand->demandItems()->delete();
            
            // Delete the demand
            $demand->delete();

            DB::commit();
            
            session()->flash('message', 'Demand deleted successfully.');
            Flux::modal('delete-demand')->close();
            $this->dispatch('refresh-demand-list');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to delete demand: ' . $e->getMessage());
        }
    }
}
