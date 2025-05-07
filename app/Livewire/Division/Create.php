<?php

namespace App\Livewire\Division;

use Flux\Flux;
use Livewire\Component;
use App\Models\Division;

class Create extends Component
{

    public $name;

    public function render()
    {
        return view('livewire.division.create');
    }


    public function save(){

        $this->validate([
            'name' => ['required', 'string', 'max:255', 'unique:divisions'],
        ]);
    
        Division::create([
            'name' => $this->name
        ]);


        Flux::modal('create-division')->close();

        $this->reset(['name']);

        session()->flash('message', 'Division created successfully.');
        $this->dispatch('refresh-division-list');
    }

}
