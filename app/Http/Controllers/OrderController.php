<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function generatePDF($order)
    {
        $order = Order::with(['items', 'user', 'vendor'])->findOrFail($order);
        
        $pdf = PDF::loadView('pdf.order', compact('order'));
        
        // Sanitize the order number by removing any forward slashes or backslashes
        $sanitizedOrderNumber = str_replace(['/', '\\'], '-', $order->order_number);
        
        return $pdf->download('order-' . $sanitizedOrderNumber . '.pdf');
    }

    public function verifyOrder($order)
    {
        $order = Order::with(['items', 'user', 'vendor'])->findOrFail($order);
        
        return view('order.verify', compact('order'));
    }
} 