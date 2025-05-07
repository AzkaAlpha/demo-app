<?php

namespace App\Livewire\Demand;

use App\Models\Demand;
use App\Models\DemandItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $demand;
    public $demand_number;
    public $regarding;
    public $demand_date;
    public $note;
    public $status;
    public $inputs = [];

    public function mount($demand)
    {
        $this->demand = Demand::with('demandItems')->findOrFail($demand);
        $this->demand_number = $this->demand->demand_number;
        $this->regarding = $this->demand->regarding;
        $this->demand_date = $this->demand->demand_date;
        $this->note = $this->demand->note;
        $this->status = $this->demand->status;

        // Initialize inputs with existing demand items
        $this->inputs = [];
        foreach ($this->demand->demandItems as $item) {
            $this->inputs[] = [
                'id' => $item->id,
                'item_name' => $item->name,
                'description' => $item->description,
                'unit' => $item->unit,
                'quantity' => $item->quantity,
            ];
        }

        // If no items exist, initialize with an empty item
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
            ]
        ];
    }

    public function render()
    {
        return view('livewire.demand.edit');
    }

    public function addItem()
    {
        $this->inputs[] = [
            'item_name' => '',
            'description' => '',
            'unit' => '',
            'quantity' => '',
        ];
    }

    public function removeItem($key)
    {
        if(count($this->inputs) > 1){
            unset($this->inputs[$key]);
            $this->inputs = array_values($this->inputs);
        }
    }

    public function update()
    {
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to edit a demand.');
            return;
        }

        $this->validate([
            'demand_number' => 'required',
            'demand_date' => 'required',
            'inputs.*.item_name' => 'required',
            'inputs.*.description' => 'required',
            'inputs.*.unit' => 'required',
            'inputs.*.quantity' => 'required',
        ]);

        try {
            DB::beginTransaction();
            
            $this->demand->update([
                'demand_number' => $this->demand_number,
                'regarding' => $this->regarding,
                'demand_date' => $this->demand_date,
                'status' => $this->status,
                'note' => $this->note,
            ]);

            // Delete existing items
            $this->demand->demandItems()->delete();

            // Create new items
            foreach($this->inputs as $input) {
                DemandItem::create([
                    'demand_id' => $this->demand->id,
                    'name' => $input['item_name'],
                    'description' => $input['description'],
                    'unit' => $input['unit'],
                    'quantity' => $input['quantity'],
                ]);
            }

            DB::commit();
            
            session()->flash('message', 'Demand updated successfully.');
            return redirect()->route('demand');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to update demand: ' . $e->getMessage());
        }
    }
}

