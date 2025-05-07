<?php

namespace App\Livewire\Order;

use Flux\Flux;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public $orderId;
    public $order = null;

    public function render()
    {
        return view('livewire.order.show');
    }

    #[On('order.show')]
    public function show($id)
    {
        $this->order = Order::with(['items', 'user.division', 'vendor'])->find($id);
        $this->orderId = $id;
        
        if ($this->order) {
            Flux::modal('show-order')->show();
        }
    }
} 