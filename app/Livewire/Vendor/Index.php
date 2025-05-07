<?php

namespace App\Livewire\Vendor;

use App\Models\Vendor;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

    public $search = '';


    #[On('refresh-vendor-list')]
    public function render()
    {

        $data = Vendor::where('name', 'like', '%' . $this->search . '%')
        ->orWhere('contact_person', 'like', '%' . $this->search . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('livewire.vendor.index', compact('data'));
    }


    public function edit($id)
    {
        $this->dispatch('vendor.edit', $id);
    }

    public function delete($id)
    {
        $this->dispatch('vendor.delete', $id);
    }

}
