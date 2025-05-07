<?php

namespace App\Livewire\Demand;

use App\Models\Demand;
use App\Models\DemandItem;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $demand_number;
    public $regarding;
    public $demand_date;
    public $note;
    public $inputs = [];

    public function mount()
    {
        $this->initializeInputs();
        $this->demand_number = $this->generateDemandNumber();
    }

    private function generateDemandNumber()
    {
        $year = date('Y');
        $month = date('m');
        
        $latestDemand = Demand::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->latest()
            ->first();
        
        $sequence = $latestDemand ? intval(substr($latestDemand->demand_number, -4)) + 1 : 1;
        
        return sprintf("DMD/%s/%s/%04d", $year, $month, $sequence);
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
        if (empty($this->inputs)) {
            $this->initializeInputs();
        }
        return view('livewire.demand.create');
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

    public function resetForm()
    {
        $this->reset(['demand_number', 'regarding', 'demand_date', 'note']);
        $this->initializeInputs();
    }

    public function save()
    {
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to create a demand.');
            return;
        }

        $this->validate([
            'demand_number' => 'required|unique:demands,demand_number',
            'demand_date' => 'required',
            'inputs.*.item_name' => 'required',
            'inputs.*.description' => 'required',
            'inputs.*.unit' => 'required',
            'inputs.*.quantity' => 'required',
        ]);

        try {
            DB::beginTransaction();
            
            $demand = Demand::create([
                'demand_number' => $this->demand_number,
                'user_id' => Auth::id(),
                'regarding' => $this->regarding,
                'demand_date' => $this->demand_date,
                'status' => 'pending',
            ]);

            foreach($this->inputs as $input) {
                DemandItem::create([
                    'demand_id' => $demand->id,
                    'name' => $input['item_name'],
                    'description' => $input['description'],
                    'unit' => $input['unit'],
                    'quantity' => $input['quantity'],
                ]);
            }

            DB::commit();
            $this->resetForm();
            
            session()->flash('message', 'Demand created successfully.');
            return redirect()->route('demand');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to create demand: ' . $e->getMessage());
        }
    }
}
