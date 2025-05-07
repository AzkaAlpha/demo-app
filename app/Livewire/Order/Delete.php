<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Delete extends Component
{
    public $order;

    public function mount($order)
    {
        $this->order = Order::findOrFail($order);
    }

    public function render()
    {
        return view('livewire.order.delete');
    }

    public function delete()
    {
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to delete an order.');
            return;
        }

        try {
            DB::beginTransaction();
            
            // Delete order items first
            $this->order->items()->delete();
            
            // Delete the order
            $this->order->delete();

            DB::commit();
            
            session()->flash('message', 'Order deleted successfully.');
            return redirect()->route('order');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to delete order: ' . $e->getMessage());
        }
    }
} 