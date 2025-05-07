<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\Vendor;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $order_number;
    public $vendor_id;
    public $regarding;
    public $order_date;
    public $note;
    public $inputs = [];
    public $vendors;

    public function mount()
    {
        $this->vendors = Vendor::all();
        $this->order_number = $this->generateOrderNumber();
        $this->initializeInputs();

    }

    private function generateOrderNumber()
    {
        $year = date('Y');
        $month = date('m');
        
        $latestOrder = Order::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->latest()
            ->first();
        
        $sequence = $latestOrder ? intval(substr($latestOrder->order_number, -4)) + 1 : 1;
        
        return sprintf("ORD/%s/%s/%04d", $year, $month, $sequence);
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
        if (empty($this->inputs)) {
            $this->initializeInputs();
        }
        return view('livewire.order.create');
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

    public function resetForm()
    {
        $this->reset(['order_number', 'vendor_id', 'regarding', 'order_date', 'note']);
        $this->initializeInputs();
    }

    public function save()
    {

    
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
            
            $order = Order::create([
                'order_number' => $this->order_number,
                'vendor_id' => $this->vendor_id,
                'user_id' => Auth::id(),
                'regarding' => $this->regarding,
                'order_date' => $this->order_date,
                'status' => 'pending',
            ]);

            foreach($this->inputs as $input) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'name' => $input['item_name'],
                    'description' => $input['description'],
                    'unit' => $input['unit'],
                    'quantity' => $input['quantity'],
                    'price' => $input['price'],
                    'total' => $input['total'],
                ]);
            }

            DB::commit();
            $this->resetForm();
            
            session()->flash('message', 'Order created successfully.');
            return redirect()->route('order');
            
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            session()->flash('error', 'Failed to create order: ' . $e->getMessage());
        }
    }
}
