<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Receipt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display all sales
     */
    public function index()
    {
        $sales = Sale::with('customer', 'processedBy')->latest()->paginate(15);
        return view('sales.index', compact('sales'));
    }

    /**
     * Show create sale form
     */
    public function create()
    {
        $customers = Customer::all();
        return view('sales.create', compact('customers'));
    }

    /**
     * Store a new sale
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'nullable|string|max:20',
            'quantity' => 'required|numeric|min:0.01',
            'rate_per_kg' => 'required|numeric|min:0.01',
            'discount' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:cash,mpesa,bank,credit',
            'payment_reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $amount = $validated['quantity'] * $validated['rate_per_kg'];
        $discount = $validated['discount'] ?? 0;
        $finalAmount = $amount - $discount;

        $sale = Sale::create([
            'sale_number' => 'SALE-' . now()->format('YmdHis') . '-' . Str::random(4),
            'customer_id' => $validated['customer_id'] ?? null,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'] ?? null,
            'quantity' => $validated['quantity'],
            'rate_per_kg' => $validated['rate_per_kg'],
            'amount' => $amount,
            'discount' => $discount,
            'final_amount' => $finalAmount,
            'payment_method' => $validated['payment_method'],
            'payment_reference' => $validated['payment_reference'] ?? null,
            'payment_status' => 'paid',
            'notes' => $validated['notes'] ?? null,
            'processed_by' => Auth::id(),
            'sale_date' => today(),
        ]);

        // Create receipt
        Receipt::create([
            'sale_id' => $sale->id,
            'receipt_number' => 'RCP-' . $sale->sale_number,
        ]);

        return redirect()->route('sales.show', $sale)->with('success', 'Sale recorded successfully');
    }

    /**
     * Show sale details
     */
    public function show(Sale $sale)
    {
        $sale->load('customer', 'processedBy', 'receipt');
        return view('sales.show', compact('sale'));
    }

    /**
     * Show edit form
     */
    public function edit(Sale $sale)
    {
        $customers = Customer::all();
        return view('sales.edit', compact('sale', 'customers'));
    }

    /**
     * Update sale
     */
    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'nullable|string|max:20',
            'quantity' => 'required|numeric|min:0.01',
            'rate_per_kg' => 'required|numeric|min:0.01',
            'discount' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:cash,mpesa,bank,credit',
            'notes' => 'nullable|string',
        ]);

        $amount = $validated['quantity'] * $validated['rate_per_kg'];
        $discount = $validated['discount'] ?? 0;

        $sale->update([
            'customer_id' => $validated['customer_id'] ?? null,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'] ?? null,
            'quantity' => $validated['quantity'],
            'rate_per_kg' => $validated['rate_per_kg'],
            'amount' => $amount,
            'discount' => $discount,
            'final_amount' => $amount - $discount,
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('sales.show', $sale)->with('success', 'Sale updated successfully');
    }

    /**
     * Delete sale
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully');
    }
}
