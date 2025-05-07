<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = '';

    public $user_type;

    public $id;

    
    #[On('refresh-user-list')]
    public function render()
    {
       
        $data = User::where('name', 'like', '%' . $this->search . '%')
        ->when($this->user_type, function ($data) {
            return $data->where('role', $this->user_type);
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        

        return view('livewire.user.index', compact('data'));
    }

    public function edit($id)
    {
        $this->dispatch('edit-user', $id);
    }

    public function delete($id)
    {
       
        $this->dispatch('delete-user', $id);
    }

  

}
