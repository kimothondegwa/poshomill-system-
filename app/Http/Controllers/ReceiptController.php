<?php

namespace App\Http\Controllers;

use App\Models\Receipt;

class ReceiptController extends Controller
{
    /**
     * Show receipt
     */
    public function show(Receipt $receipt)
    {
        $receipt->load('sale.customer', 'sale.processedBy');
        return view('receipts.show', compact('receipt'));
    }

    /**
     * Print receipt
     */
    public function print(Receipt $receipt)
    {
        $receipt->markAsPrinted();
        return response()->view('receipts.print', ['receipt' => $receipt]);
    }

    /**
     * Download receipt as PDF
     */
    public function download(Receipt $receipt)
    {
        // PDF generation logic would go here
        return redirect()->route('receipts.show', $receipt)->with('success', 'Receipt downloaded');
    }
}
