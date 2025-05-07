<?php

namespace App\Livewire\User;

use App\Models\User;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class Delete extends Component
{

    public $userId;

    public function render()
    {
        return view('livewire.user.delete');
    }


    #[On('delete-user')]
    public function delete($id)
    {
       
        $this->userId = $id;
        Flux::modal('delete-user')->show();
    }

    public function destroy()
    {
        $user = User::find($this->userId);
        $user->delete();
        
        session()->flash('message', 'User deleted successfully.');
        Flux::modal('delete-user')->close();
        $this->dispatch('refresh-user-list');
    
    }
}
