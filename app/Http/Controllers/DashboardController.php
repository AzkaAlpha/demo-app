<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Demand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Order Statistics (existing)
        $totalOrders = Order::count();
        $processOrders = Order::where('status', 'processed')->count();
        $processRate = $totalOrders > 0 ? round(($processOrders / $totalOrders) * 100) : 0;
        $processPercentage = $processRate;
        
        $approvedOrders = Order::where('status', 'approved')->count();
        $approvedRate = $totalOrders > 0 ? round(($approvedOrders / $totalOrders) * 100) : 0;
        $approvedPercentage = $approvedRate;
        
        $rejectedOrders = Order::where('status', 'rejected')->count();
        $rejectionRate = $totalOrders > 0 ? round(($rejectedOrders / $totalOrders) * 100) : 0;
        
        // Demand Statistics (new)
        $totalDemands = Demand::count();
        $processedDemands = Demand::where('status', 'processed')->count();
        $approvedDemands = Demand::where('status', 'approved')->count();
        $rejectedDemands = Demand::where('status', 'rejected')->count();
        $completedDemands = Demand::where('status', 'completed')->count();
        $demandCompletionRate = $totalDemands > 0 ? round(($completedDemands / $totalDemands) * 100) : 0;
        
        // Recent Demands (new)
        $recentDemands = Demand::with(['user.division'])
            ->latest()
            ->take(5)
            ->get();
        
        // Order Growth
        $lastMonthOrders = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $currentMonthOrders = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $orderGrowth = $lastMonthOrders > 0 ? round((($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100) : 0;
        
        // Recent Orders
        $recentOrders = Order::with(['vendor', 'user.division'])
            ->latest()
            ->take(5)
            ->get();
        
        // Monthly Trend
        $monthlyOrders = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('month')
        ->get();

        // If no orders this month, use total orders for percentage calculation
        $maxOrders = $currentMonthOrders > 0 ? $currentMonthOrders : $totalOrders;

        $monthlyOrders = $monthlyOrders->map(function ($item) use ($maxOrders) {
            $item->month = Carbon::create()->month($item->month)->format('M');
            $item->percentage = $maxOrders > 0 ? ($item->total / $maxOrders) * 100 : 0;
            return $item;
        });

        // If no monthly data, create empty data for the current month
        if ($monthlyOrders->isEmpty()) {
            $monthlyOrders = collect([
                (object)[
                    'month' => Carbon::now()->format('M'),
                    'percentage' => 0
                ]
            ]);
        }

        return view('dashboard', compact(
            'totalOrders',
            'processOrders',
            'processRate',
            'processPercentage',
            'approvedOrders',
            'approvedRate',
            'approvedPercentage',
            'rejectedOrders',
            'rejectionRate',
            'totalDemands',
            'processedDemands',
            'approvedDemands',
            'rejectedDemands',
            'completedDemands',
            'demandCompletionRate',
            'recentDemands',
            'orderGrowth',
            'recentOrders',
            'monthlyOrders'
        ));
    }
}