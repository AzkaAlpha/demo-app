<?php

namespace App\Livewire\Rank;

use Flux\Flux;
use App\Models\Rank;
use Livewire\Component;

class Create extends Component
{

    public $name, $description;

    public function render()
    {
        return view('livewire.rank.create');
    }


    public function save(){
        $this->validate([
            'name' => ['required', 'string', 'max:255', 'unique:ranks'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        Rank::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->reset(['name', 'description']);
        
        Flux::modal('create-rank')->close();

        session()->flash('message', 'Rank created successfully.');
        $this->dispatch('refresh-rank-list');
    }
}
