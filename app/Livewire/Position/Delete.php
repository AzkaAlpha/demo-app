<?php

namespace App\Livewire\Position;

use Flux\Flux;
use Livewire\Component;
use App\Models\Position;
use Livewire\Attributes\On;

class Delete extends Component
{

    public $positionId;

    public function render()
    {
        return view('livewire.position.delete');
    }

    #[On('position.delete')]
    public function delete($id)
    {

        $data = Position::find($id);
        $this->positionId = $data->id;
        Flux::modal('delete-position')->show();
    }

    public function destroy()
    {
        Position::find($this->positionId)->delete();

        Flux::modal('delete-position')->close();

        $this->dispatch('refresh-position-list');

    }
}
