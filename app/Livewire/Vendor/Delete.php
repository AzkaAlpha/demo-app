<?php

namespace App\Livewire\Vendor;

use Flux\Flux;
use App\Models\Vendor;
use Livewire\Component;
use Livewire\Attributes\On;

class Delete extends Component
{

    public $vendorId;

    public function render()
    {
        return view('livewire.vendor.delete');
    }

    #[On('vendor.delete')]
    public function delete($id)
    {
        $data = Vendor::find($id);
        $this->vendorId = $data->id;
        Flux::modal('delete-vendor')->show();
    }

    public function destroy()
    {
        Vendor::find($this->vendorId)->delete();
        Flux::modal('delete-vendor')->close();
        session()->flash('message', 'Vendor deleted successfully.');
        $this->dispatch('refresh-vendor-list');
    }

}
