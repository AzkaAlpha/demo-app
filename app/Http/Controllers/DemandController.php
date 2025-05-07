<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DemandController extends Controller
{
    public function generatePDF($demand)
    {
        $demand = Demand::with(['demandItems', 'user'])->findOrFail($demand);
        
        $pdf = PDF::loadView('pdf.demand', compact('demand'));
        
        // Sanitize the demand number by removing any forward slashes or backslashes
        $sanitizedDemandNumber = str_replace(['/', '\\'], '-', $demand->demand_number);
        
        return $pdf->download('demand-' . $sanitizedDemandNumber . '.pdf');
    }

    public function verifyDemand($demand)
    {
        $demand = Demand::with(['demandItems', 'user'])->findOrFail($demand);
        
        return view('demand.verify', compact('demand'));
    }
}
