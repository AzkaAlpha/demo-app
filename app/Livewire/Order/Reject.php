<?php

namespace App\Livewire\Order;

use Flux\Flux;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Reject extends Component
{
    public $orderId;
    public $note;

    public function render()
    {
        return view('livewire.order.reject');
    }

    #[On('order.reject')]
    public function reject($id)
    {
        $data = Order::find($id);
        $this->orderId = $data->id;
        Flux::modal('reject-order')->show();
    }

    public function rejectOrder()
    {
        $this->validate([
            'note' => ['required', 'string', 'max:255'],
        ]);

        $order = Order::find($this->orderId);
        $order->update([
            'status' => 'rejected',
            'note' => $this->note,
            'rejected' => Auth::user()->id
        ]);

        Flux::modal('reject-order')->close();
        $this->reset(['note']);

        $this->dispatch('refresh-order-list');

        session()->flash('message', 'Order rejected successfully.');
    }
} 