<?php

namespace App\Livewire\Division;

use Flux\Flux;
use Livewire\Component;
use App\Models\Division;
use Livewire\Attributes\On;

class Delete extends Component
{

    public $divisionId;

    public function render()
    {
        return view('livewire.division.delete');
    }
    #[On('division.delete')]
    public function delete($id)
    {
        $data = Division::find($id);
        $this->divisionId = $data->id;
        Flux::modal('delete-division')->show();
    }

    public function destroy()
    {
        Division::find($this->divisionId)->delete();

        Flux::modal('delete-division')->close();

        $this->dispatch('refresh-division-list');

    }
}
