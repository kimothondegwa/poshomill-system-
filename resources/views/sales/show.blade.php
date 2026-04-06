@extends('layouts.app')

@section('title', 'Sale Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-receipt me-2"></i>Sale #{{ $sale->sale_number }}</h2>
    <div>
        <a href="{{ route('sales.edit', $sale) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Sale Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Sale Number:</strong> {{ $sale->sale_number }}</p>
                <p><strong>Customer:</strong> {{ $sale->customer_name }}</p>
                <p><strong>Sale Date:</strong> {{ $sale->sale_date->format('M d, Y') }}</p>
                <p><strong>Stock:</strong> {{ optional($sale->stock)->product_name ?? 'N/A' }}</p>
                <p><strong>Quantity:</strong> {{ $sale->quantity }} kg</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Payment Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Price per kg:</strong> KSh {{ number_format($sale->price_per_kg, 2) }}</p>
                <p><strong>Subtotal:</strong> KSh {{ number_format($sale->subtotal, 2) }}</p>
                <p><strong>Discount:</strong> KSh {{ number_format($sale->discount, 2) }}</p>
                <p><strong class="text-success">Final Amount:</strong> <span class="h5">KSh {{ number_format($sale->final_amount, 2) }}</span></p>
                <p><strong>Payment Method:</strong> <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $sale->payment_method)) }}</span></p>
            </div>
        </div>
    </div>
</div>

@if ($sale->notes)
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Notes</h5>
        </div>
        <div class="card-body">
            {{ $sale->notes }}
        </div>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Additional Details</h5>
    </div>
    <div class="card-body">
        <p><strong>Created by:</strong> {{ $sale->user->full_name ?? 'N/A' }}</p>
        <p><strong>Created at:</strong> {{ $sale->created_at->format('M d, Y H:i') }}</p>
        @if ($sale->updated_at->ne($sale->created_at))
            <p><strong>Updated at:</strong> {{ $sale->updated_at->format('M d, Y H:i') }}</p>
        @endif
    </div>
</div>
@endsection
