<?php

namespace App\Livewire\Division;

use Flux\Flux;

use Livewire\Component;
use App\Models\Division;
use Livewire\Attributes\On;

class Edit extends Component
{

    public $divisionId, $name;

    public function render()
    {
        return view('livewire.division.edit');
    }

    #[On('division.edit')]
    public function edit($id)
    {

        $data = Division::find($id);

        $this->name = $data->name;
        $this->divisionId = $data->id;

       Flux::modal('edit-division')->show();
    }


    public function update () 
    {

        $this->validate([
            'name' => ['required', 'string', 'max:255', 'unique:divisions'],
          
        ]);

        Division::find($this->divisionId)->update([
            'name' => $this->name,
        ]);

        Flux::modal('edit-division')->close();

        $this->dispatch('refresh-division-list');
    }
}
