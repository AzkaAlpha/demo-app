<?php

namespace App\Livewire\Position;

use Livewire\Component;
use App\Models\Position;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search ='';

    #[On('refresh-position-list')]
    public function render()
    {

        $data = Position::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.position.index', compact('data'));
    }


    public function edit($id)
    {
        $this->dispatch('position.edit', $id);
    }

    public function delete($id)
    {
        $this->dispatch('position.delete', $id);
    }
}
