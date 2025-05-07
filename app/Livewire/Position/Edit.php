<?php

namespace App\Livewire\Position;

use Flux\Flux;
use Livewire\Component;
use App\Models\Position;
use Livewire\Attributes\On;

class Edit extends Component
{

    public $name, $positionId;
   

    public function render()
    {
        return view('livewire.position.edit');
    }

    #[On('position.edit')]
    public function edit($id)
    {

        $data = Position::find($id);

        $this->name = $data->name;
        $this->positionId = $data->id;

       Flux::modal('edit-position')->show();
    }


    public function update () 
    {

        $this->validate([
            'name' => ['required', 'string', 'max:255', 'unique:positions'],
        
        ]);

        Position::find($this->positionId)->update([
            'name' => $this->name,
           
        ]);

        Flux::modal('edit-position')->close();

        $this->dispatch('refresh-position-list');
    }
}
