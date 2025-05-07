<?php

namespace App\Livewire\User;


use Flux\Flux;
use App\Models\Rank;
use App\Models\User;
use Livewire\Component;
use App\Models\Division;
use App\Models\Position;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    
    public $division_id, $nip, $rank_id, $position_id, $name, $email, $password, $has_authority, $avatar, $role;
    

    public function render()
    {
        $position = Position::all();
        $division = Division::all();
        $rank = Rank::all();

        return view('livewire.user.create', compact('rank', 'position', 'division'));
    }


    public function save(){

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'division_id' => ['required'],
            'rank_id' => ['required'],
            'position_id' => ['required'],
            'has_authority' => ['required'],
            'nip' => ['required'],
            'role' => ['required'],
        ]);

        if($this->avatar){
            $this->validate([
                'avatar' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            ]);
        }

       User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'division_id' => $this->division_id,
            'rank_id' => $this->rank_id,
            'position_id' => $this->position_id,
            'has_authority' => $this->has_authority,
            'nip' => $this->nip,
            'role' => $this->role,
            'avatar' => $this->avatar->store('photo', 'public')
        ]);

        $this->reset([
            'name', 'email', 'password', 'division_id', 'rank_id', 'position_id', 'has_authority', 'nip', 'role', 'avatar'
        ]);

        Flux::modal('create-user')->close();

        session()->flash('message', 'User created successfully.');
        $this->dispatch('refresh-user-list');

    }

}
