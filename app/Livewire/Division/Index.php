<?php

namespace App\Livewire\Division;

use Livewire\Component;
use App\Models\Division;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search ='';


    #[On('refresh-division-list')]
    public function render()
    {

        $data = Division::where('name', 'like', '%' . $this->search . '%')
        ->orWhere('description', 'like', '%' . $this->search . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('livewire.division.index', compact('data'));
    }


    public function edit($id)
    {
        $this->dispatch('division.edit', $id);
    }

    public function delete($id)
    {
        $this->dispatch('division.delete', $id);
    }

    
}
