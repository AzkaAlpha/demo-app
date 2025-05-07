<?php

namespace App\Livewire\Rank;

use Flux\Flux;
use App\Models\Rank;
use Livewire\Component;
use Livewire\Attributes\On;

class Delete extends Component
{

    public $rankId;

    public function render()
    {
        return view('livewire.rank.delete');
    }

    #[On('rank.delete')]
    public function delete($id)
    {

        
        $data = Rank::find($id);
        $this->rankId = $data->id;
        Flux::modal('delete-rank')->show();
    }

    public function destroy()
    {
        Rank::find($this->rankId)->delete();

        Flux::modal('delete-rank')->close();

        $this->dispatch('refresh-rank-list');

    }
}
