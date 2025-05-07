<?php

namespace App\Livewire\Demand;

use Flux\Flux;
use App\Models\Demand;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public $demandId;
    public $demand = null;

    public function render()
    {
        return view('livewire.demand.show');
    }

    #[On('demand.show')]
    public function show($id)
    {
        $this->demand = Demand::with(['demandItems', 'user.division'])->find($id);
        $this->demandId = $id;
        
        if ($this->demand) {
            Flux::modal('show-demand')->show();
        }
    }
}
