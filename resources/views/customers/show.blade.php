@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user me-2"></i>{{ $customer->name }}</h2>
    <div>
        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Contact Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $customer->name }}</p>
                <p><strong>Email:</strong> {{ $customer->email ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                <p><strong>Location:</strong> {{ $customer->location ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Statistics</h5>
            </div>
            <div class="card-body">
                <p><strong>Total Purchases:</strong> {{ $customer->sales->count() }}</p>
                <p><strong>Total Spent:</strong> KSh {{ number_format($customer->sales->sum('final_amount'), 2) }}</p>
                <p><strong>Member Since:</strong> {{ $customer->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
</div>

@if ($customer->notes)
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Notes</h5>
        </div>
        <div class="card-body">
            {{ $customer->notes }}
        </div>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Recent Purchases</h5>
    </div>
    <div class="card-body">
        @if ($customer->sales->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Sale #</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer->sales->take(10) as $sale)
                            <tr>
                                <td><a href="{{ route('sales.show', $sale) }}">{{ $sale->sale_number }}</a></td>
                                <td>{{ $sale->stock->product_name }}</td>
                                <td>{{ $sale->quantity }} kg</td>
                                <td>KSh {{ number_format($sale->final_amount, 2) }}</td>
                                <td>{{ $sale->sale_date->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No purchases yet.</p>
        @endif
    </div>
</div>
@endsection
