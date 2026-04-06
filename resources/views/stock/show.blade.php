@extends('layouts.app')

@section('title', 'Stock Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-box me-2"></i>{{ $stock->product_name }}</h2>
    <div>
        <a href="{{ route('stock.edit', $stock) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('stock.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Stock Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Product:</strong> {{ $stock->product_name }}</p>
                <p><strong>Batch Number:</strong> {{ $stock->batch_number }}</p>
                <p><strong>Quantity:</strong> <span class="badge bg-success">{{ $stock->quantity }} kg</span></p>
                <p><strong>Unit Cost:</strong> KSh {{ number_format($stock->cost_per_kg, 2) }} per kg</p>
                <p><strong>Total Cost:</strong> KSh {{ number_format($stock->total_cost, 2) }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Additional Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Expiry Date:</strong>
                    @if ($stock->expiry_date)
                        @if ($stock->expiry_date->isPast())
                            <span class="badge bg-danger">{{ $stock->expiry_date->format('M d, Y') }} (Expired)</span>
                        @else
                            {{ $stock->expiry_date->format('M d, Y') }}
                        @endif
                    @else
                        N/A
                    @endif
                </p>
                <p><strong>Supplier:</strong> {{ $stock->supplier ?? 'N/A' }}</p>
                <p><strong>Added by:</strong> {{ $stock->user->full_name ?? 'N/A' }}</p>
                <p><strong>Added at:</strong> {{ $stock->created_at->format('M d, Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

@if ($stock->notes)
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Notes</h5>
        </div>
        <div class="card-body">
            {{ $stock->notes }}
        </div>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Stock Movements</h5>
    </div>
    <div class="card-body">
        @if ($stock->stockMovements->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Reference</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stock->stockMovements as $movement)
                            <tr>
                                <td>{{ $movement->created_at->format('M d, Y') }}</td>
                                <td><span class="badge bg-info">{{ ucfirst($movement->movement_type) }}</span></td>
                                <td>{{ $movement->quantity }} kg</td>
                                <td>{{ $movement->reference_number ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No stock movements recorded yet.</p>
        @endif
    </div>
</div>
@endsection
