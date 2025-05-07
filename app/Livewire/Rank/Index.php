<?php

namespace App\Livewire\Rank;

use App\Models\Rank;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

   

    public $search ='';

    
    #[On('refresh-rank-list')]
    public function render()
    {
        $data = Rank::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.rank.index', compact('data'));
    }

    public function edit($id)
    {
        $this->dispatch('rank.edit', $id);
    }

    public function delete($id)
    {
        $this->dispatch('rank.delete', $id);
    }

    
}
