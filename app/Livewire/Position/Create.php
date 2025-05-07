<?php

namespace App\Livewire\Position;

use Flux\Flux;
use Livewire\Component;
use App\Models\Position;

class Create extends Component
{

    public $name;

    public function render()
    {
        return view('livewire.position.create');
    }

    public function save(){
        $this->validate([
            'name' => ['required', 'string', 'max:255', 'unique:positions'],
         
        ]);

        Position::create([
            'name' => $this->name,
            
        ]);

        $this->reset(['name']);
        
        Flux::modal('create-position')->close();

        session()->flash('message', 'position created successfully.');
        $this->dispatch('refresh-position-list');
    }
}
