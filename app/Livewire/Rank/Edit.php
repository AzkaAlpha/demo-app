<?php

namespace App\Livewire\Rank;

use App\Models\Rank;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class Edit extends Component
{

    public $name, $description, $rankId;

    public function render()
    {
        return view('livewire.rank.edit');
    }


    #[On('rank.edit')]
    public function edit($id)
    {

        $data = Rank::find($id);

        $this->name = $data->name;
        $this->description = $data->description;
        $this->rankId = $data->id;

       Flux::modal('edit-rank')->show();
    }


    public function update () 
    {

        $this->validate([
            'name' => ['required', 'string', 'max:255', 'unique:ranks'],
            'description' => ['required', 'string', 'max:255']
        ]);

        Rank::find($this->rankId)->update([
            'name' => $this->name,
            'description' => $this->description
        ]);

        Flux::modal('edit-rank')->close();

        $this->dispatch('refresh-rank-list');
    }


}
