@extends('layouts.app')

@section('title', 'Receipt')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-receipt me-2"></i>Receipt #{{ $receipt->receipt_number }}</h2>
    <div>
        <form action="{{ route('receipts.print', $receipt) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-print me-2"></i>Print
            </button>
        </form>
        <a href="{{ route('receipts.download', $receipt) }}" class="btn btn-secondary">
            <i class="fas fa-download me-2"></i>Download PDF
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Company Information</h5>
                <p class="mb-0"><strong>Posho Mill</strong></p>
                <p class="mb-0">Phone: +254 XXX XXX XXX</p>
                <p>Email: info@poshomill.com</p>
            </div>
            <div class="col-md-6 text-end">
                <h5>Receipt Details</h5>
                <p class="mb-0"><strong>Receipt #:</strong> {{ $receipt->receipt_number }}</p>
                <p class="mb-0"><strong>Date:</strong> {{ $receipt->created_at->format('M d, Y H:i') }}</p>
            </div>
        </div>

        <hr>

        <div class="row mb-4">
            <div class="col-md-6">
                <h6>Customer</h6>
                <p class="mb-0"><strong>{{ $receipt->sale->customer_name }}</strong></p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $receipt->sale->stock->product_name }}</td>
                    <td>{{ $receipt->sale->quantity }} kg</td>
                    <td>KSh {{ number_format($receipt->sale->price_per_kg, 2) }}</td>
                    <td>KSh {{ number_format($receipt->sale->subtotal, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="row mb-4">
            <div class="col-md-6 ms-auto">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Subtotal:</strong></td>
                        <td>KSh {{ number_format($receipt->sale->subtotal, 2) }}</td>
                    </tr>
                    @if ($receipt->sale->discount > 0)
                        <tr>
                            <td><strong>Discount:</strong></td>
                            <td>-KSh {{ number_format($receipt->sale->discount, 2) }}</td>
                        </tr>
                    @endif
                    <tr class="table-active">
                        <td><strong>Total:</strong></td>
                        <td><strong>KSh {{ number_format($receipt->sale->final_amount, 2) }}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Payment Method:</strong></td>
                        <td>{{ ucfirst(str_replace('_', ' ', $receipt->sale->payment_method)) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <hr>

        <div class="text-center text-muted">
            <p>Thank you for your business!</p>
            <p><small>Generated on {{ now()->format('M d, Y H:i') }}</small></p>
        </div>
    </div>
</div>
@endsection
