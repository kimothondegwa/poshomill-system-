<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Stock;
use App\Models\Customer;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show dashboard
     */
    public function index()
    {
        $totalSales = Sale::sum('final_amount');
        $totalQuantitySold = Sale::sum('quantity');
        $totalCustomers = Customer::count();
        $currentStock = Stock::sum('quantity');
        
        $totalUsers = User::count();
        $activeSales = Sale::whereDate('sale_date', today())->count();
        $recentSales = Sale::latest()->limit(10)->get();
        
        $stockValue = Stock::sum('total_cost');
        $averageSaleAmount = Sale::avg('final_amount');

        return view('dashboard', [
            'totalSales' => $totalSales,
            'totalQuantitySold' => $totalQuantitySold,
            'totalCustomers' => $totalCustomers,
            'currentStock' => $currentStock,
            'totalUsers' => $totalUsers,
            'activeSales' => $activeSales,
            'recentSales' => $recentSales,
            'stockValue' => $stockValue,
            'averageSaleAmount' => $averageSaleAmount,
        ]);
    }
}
