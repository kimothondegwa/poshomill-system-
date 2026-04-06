<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Stock;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReportController extends Controller
{
    /**
     * Show reports index
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Sales report
     */
    public function sales()
    {
        $sales = Sale::latest()->get();
        return view('reports.sales', compact('sales'));
    }

    /**
     * Stock report
     */
    public function stock()
    {
        $stock = Stock::all();
        $totalStock = Stock::sum('quantity');
        $totalStockValue = Stock::sum('total_cost');
        $totalProducts = Stock::count();

        return view('reports.stock', compact('stock', 'totalStock', 'totalStockValue', 'totalProducts'));
    }

    /**
     * Customers report
     */
    public function customers()
    {
        $customers = Customer::all();
        $totalCustomers = Customer::count();

        if (Schema::hasColumn('customers', 'visit_count')) {
            $activeCustomers = Customer::where('visit_count', '>', 0)->count();
        } else {
            // fallback until migration has been run
            $activeCustomers = Customer::has('sales')->count();
        }

        $totalRevenue = Sale::sum('final_amount');

        return view('reports.customers', compact('customers', 'totalCustomers', 'activeCustomers', 'totalRevenue'));
    }

    /**
     * Financial report
     */
    public function financial()
    {
        $transactions = Transaction::latest()->get();
        $totalRevenue = Sale::sum('final_amount');
        $totalCost = Stock::sum('total_cost');
        $grossProfit = $totalRevenue - $totalCost;
        $profitMargin = $totalRevenue > 0 ? ($grossProfit / $totalRevenue) * 100 : 0;

        return view('reports.financial', compact('transactions', 'totalRevenue', 'totalCost', 'grossProfit', 'profitMargin'));
    }

    /**
     * Export report
     */
    public function export()
    {
        // Export logic would go here
        return back()->with('success', 'Report exported successfully');
    }
}
