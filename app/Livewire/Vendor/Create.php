<?php

namespace App\Livewire\Vendor;

use App\Models\Vendor;
use Flux\Flux;
use Livewire\Component;

class Create extends Component
{

    public $name, $contact_person, $email, $phone, $address, $city;

    public function render()
    {
        return view('livewire.vendor.create');
    }

    public function save()
    {

        $this->validate([
            'name' => ['required', 'string', 'max:255', 'unique:vendors'],
            'contact_person' => [ 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255', 'unique:vendors'],
            'phone' => [ 'string', 'max:255'],
            'address' => ['string', 'max:255'],
        ]);

        Vendor::create([
            'name' => $this->name,
            'contact_person' => $this->contact_person,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
        ]);

        $this->reset();

        Flux::modal('create-vendor')->close();

        session()->flash('message', 'Vendor created successfully.');
        $this->dispatch('refresh-vendor-list');

        
    }
}
