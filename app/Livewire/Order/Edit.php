<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\Vendor;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $order;
    public $order_number;
    public $vendor_id;
    public $regarding;
    public $order_date;
    public $note;
    public $status;
    public $inputs = [];
    public $vendors;

    public function mount($order)
    {
        $this->order = Order::findOrFail($order);
        $this->order_number = $this->order->order_number;
        $this->vendor_id = $this->order->vendor_id;
        $this->regarding = $this->order->regarding;
        $this->order_date = $this->order->order_date;
        $this->note = $this->order->note;
        $this->status = $this->order->status;
        $this->vendors = Vendor::all();

        // Load existing order items
        foreach ($this->order->items as $item) {
            $this->inputs[] = [
                'id' => $item->id,
                'item_name' => $item->name,
                'description' => $item->description,
                'unit' => $item->unit,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->total,
            ];
        }

        if (empty($this->inputs)) {
            $this->initializeInputs();
        }
    }

    protected function initializeInputs()
    {
        $this->inputs = [
            [
                'item_name' => '',
                'description' => '',
                'unit' => '',
                'quantity' => '',
                'price' => '',
                'total' => '',
            ]
        ];
    }

    public function render()
    {
        return view('livewire.order.edit');
    }

    public function addItem()
    {
        $this->inputs[] = [
            'item_name' => '',
            'description' => '',
            'unit' => '',
            'quantity' => '',
            'price' => '',
            'total' => '',
        ];
    }

    public function removeItem($key)
    {
        if(count($this->inputs) > 1){
            unset($this->inputs[$key]);
            $this->inputs = array_values($this->inputs);
        }
    }

    public function save()
    {
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to edit an order.');
            return;
        }

        $this->validate([
            'order_number' => 'required',
            'vendor_id' => 'required',
            'order_date' => 'required',
            'inputs.*.item_name' => 'required',
            'inputs.*.description' => 'required',
            'inputs.*.unit' => 'required',
            'inputs.*.quantity' => 'required',
            'inputs.*.price' =>'required',
            'inputs.*.total' =>'required',
        ]);

        try {
            DB::beginTransaction();
            
            $this->order->update([
                'order_number' => $this->order_number,
                'vendor_id' => $this->vendor_id,
                'regarding' => $this->regarding,
                'order_date' => $this->order_date,
                'status' => $this->status,
                'note' => $this->note,
            ]);

            // Delete existing items
            $this->order->items()->delete();

            // Create new items
            foreach($this->inputs as $input) {
                OrderItem::create([
                    'order_id' => $this->order->id,
                    'name' => $input['item_name'],
                    'description' => $input['description'],
                    'unit' => $input['unit'],
                    'quantity' => $input['quantity'],
                    'price' => $input['price'],
                    'total' => $input['total'],
                ]);
            }

            DB::commit();
            
            session()->flash('message', 'Order updated successfully.');
            return redirect()->route('order');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to update order: ' . $e->getMessage());
        }
    }
} 