<?php

namespace App\Livewire\Vendor;

use App\Models\Vendor;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class Edit extends Component
{

    public $name, $contact_person, $email, $phone, $address, $city;
    public $vendorId;

    public function render()
    {
        return view('livewire.vendor.edit');
    }

    #[On('vendor.edit')]
    public function edit($id)
    {
          
        $data = Vendor::find($id);

        $this->name = $data->name;
        $this->contact_person = $data->contact_person;
        $this->email = $data->email;
        $this->phone = $data->phone;
        $this->address = $data->address;
        $this->city = $data->city;
        $this->vendorId = $data->id;

        Flux::modal('edit-vendor')->show();
    }

    public function update(){

        $this->validate([
            'name' => ['required', 'string', 'max:255', 'unique:vendors,name,'.$this->vendorId],
            'contact_person' => [ 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255', 'unique:vendors,email,'.$this->vendorId],
            'phone' => [ 'string', 'max:255'],
            'address' => ['string', 'max:255'],
        ]);

        Vendor::find($this->vendorId)->update([
            'name' => $this->name,
            'contact_person' => $this->contact_person,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
        ]);

        $this->reset();

        Flux::modal('edit-vendor')->close();

        session()->flash('message', 'Vendor updated successfully.');
        $this->dispatch('refresh-vendor-list');
    }
}
