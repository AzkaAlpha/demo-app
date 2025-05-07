<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    protected $queryString = ['search', 'status'];
    public $note = '';

    #[On('refresh-order-list')]
    public function render()
    {
        $query = Order::with('items', 'user', 'vendor')
            ->where(function($q) {
                $q->where('order_number', 'like', '%' . $this->search . '%')
                  ->orWhere('regarding', 'like', '%' . $this->search . '%')
                  ->orWhere('order_date', 'like', '%' . $this->search . '%');
            });

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $data = $query->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.order.index', compact('data'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function processedOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update([
           'status' =>'processed',
           'processed' => Auth::user()->id
        ]);
        $this->dispatch('refresh-order-list');
        session()->flash('message', 'Order has been processed successfully.');
    }

    public function verifiedOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update([
            'status' => 'verified',
            'verified' => Auth::user()->id
        ]);

        $this->dispatch('refresh-order-list');
        session()->flash('message', 'Order has been verified successfully.');
    }

    public function validatedOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update([
           'status' =>'validated',
           'validated' => Auth::user()->id
        ]);
        $this->dispatch('refresh-order-list');
        session()->flash('message', 'Order has been validated successfully.');
    }

    public function approvedOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update([
            'status' => 'approved',
            'approved' => Auth::user()->id
        ]);

        $this->dispatch('refresh-order-list');
        session()->flash('message', 'Order has been approved successfully.');
    }

    public function rejectedOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update([
            'status' => 'rejected',
            'rejected' => Auth::user()->id,
            'note' => $this->note
        ]);

        $this->dispatch('refresh-order-list');
        session()->flash('message', 'Order has been rejected successfully.');
    }

    public function generatePDF($orderId)
    {
        return redirect()->route('order.pdf', ['order' => $orderId]);
    }
}
