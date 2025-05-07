<?php

namespace App\Livewire\User;

use Flux\Flux;
use App\Models\Rank;
use App\Models\User;
use Livewire\Component;
use App\Models\Division;
use App\Models\Position;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;


class Edit extends Component
{

    use WithFileUploads;

    public $division_id, $nip, $rank_id, $position_id, $name, $email, $password, $has_authority, $avatar, $role;
    public $id;
    public $newAvatar;
    
 

    public function render()
    {
        
        $rank = Rank::all();
        $position = Position::all();
        $division = Division::all();

        return view('livewire.user.edit', compact('rank', 'position', 'division'));
    }


    #[On('edit-user')]
    public function editUser($id)
    {
       $data = User::find($id);
        $this->id = $data->id;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->division_id = $data->division_id;
        $this->rank_id = $data->rank_id;
        $this->position_id = $data->position_id;
        $this->has_authority = $data->has_authority;
        $this->nip = $data->nip;
        $this->role = $data->role;
        $this->avatar = $data->avatar;
        $this->password = $data->password;

        Flux::modal('edit-user')->show();
    }

    public function update()
    {


        $user = User::find($this->id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->division_id = $this->division_id;
        $user->rank_id = $this->rank_id;
        $user->position_id = $this->position_id;
        $user->has_authority = $this->has_authority;
        $user->nip = $this->nip;
        $user->role = $this->role;
          // Periksa apakah avatar adalah file yang diunggah
            if ($this->newAvatar) {
                $user->avatar = $this->newAvatar->store('photo', 'public'); // Simpan file baru
            }
        $user->password = $this->password;
        $user->update();

        Flux::modal('edit-user')->close();

        session()->flash('message', 'User updated successfully.');
        $this->dispatch('refresh-user-list');

    }



}
