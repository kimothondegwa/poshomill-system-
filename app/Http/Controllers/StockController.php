<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display all stock
     */
    public function index()
    {
        $stock = Stock::with('addedBy')->latest()->paginate(15);
        $totalQuantity = Stock::sum('quantity');
        $totalValue = Stock::sum('total_cost');
        
        return view('stock.index', compact('stock', 'totalQuantity', 'totalValue'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('stock.create');
    }

    /**
     * Store new stock
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:100',
            'quantity' => 'required|numeric|min:0.01',
            'cost_per_kg' => 'required|numeric|min:0.01',
            'supplier' => 'nullable|string|max:100',
            'supplier_phone' => 'nullable|string|max:20',
            'batch_number' => 'nullable|string|max:50',
            'quality_grade' => 'required|in:Grade A,Grade B,Grade C',
            'date_received' => 'required|date',
            'expiry_date' => 'nullable|date|after:date_received',
            'notes' => 'nullable|string',
        ]);

        $stock = Stock::create([
            'product_name' => $validated['product_name'],
            'quantity' => $validated['quantity'],
            'cost_per_kg' => $validated['cost_per_kg'],
            'total_cost' => $validated['quantity'] * $validated['cost_per_kg'],
            'supplier' => $validated['supplier'] ?? null,
            'supplier_phone' => $validated['supplier_phone'] ?? null,
            'batch_number' => $validated['batch_number'] ?? null,
            'quality_grade' => $validated['quality_grade'],
            'date_received' => $validated['date_received'],
            'expiry_date' => $validated['expiry_date'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'added_by' => Auth::id(),
        ]);

        return redirect()->route('stock.show', $stock)->with('success', 'Stock added successfully');
    }

    /**
     * Show stock details
     */
    public function show(Stock $stock)
    {
        $stock->load('addedBy', 'movements');
        return view('stock.show', compact('stock'));
    }

    /**
     * Show edit form
     */
    public function edit(Stock $stock)
    {
        return view('stock.edit', compact('stock'));
    }

    /**
     * Update stock
     */
    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:100',
            'quantity' => 'required|numeric|min:0.01',
            'cost_per_kg' => 'required|numeric|min:0.01',
            'supplier' => 'nullable|string|max:100',
            'quality_grade' => 'required|in:Grade A,Grade B,Grade C',
            'notes' => 'nullable|string',
        ]);

        $stock->update([
            'product_name' => $validated['product_name'],
            'quantity' => $validated['quantity'],
            'cost_per_kg' => $validated['cost_per_kg'],
            'total_cost' => $validated['quantity'] * $validated['cost_per_kg'],
            'supplier' => $validated['supplier'] ?? null,
            'quality_grade' => $validated['quality_grade'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('stock.show', $stock)->with('success', 'Stock updated successfully');
    }

    /**
     * Delete stock
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stock.index')->with('success', 'Stock deleted successfully');
    }
}
