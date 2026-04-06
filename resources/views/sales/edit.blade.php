@extends('layouts.app')

@section('title', 'Edit Sale')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-edit me-2"></i>Edit Sale #{{ $sale->sale_number }}</h2>
    <a href="{{ route('sales.show', $sale) }}" class="btn btn-secondary">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('sales.update', $sale) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                           id="customer_name" name="customer_name" required value="{{ old('customer_name', $sale->customer_name) }}">
                    @error('customer_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="sale_date" class="form-label">Sale Date</label>
                    <input type="date" class="form-control @error('sale_date') is-invalid @enderror"
                           id="sale_date" name="sale_date" required value="{{ old('sale_date', $sale->sale_date->format('Y-m-d')) }}">
                    @error('sale_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="quantity" class="form-label">Quantity (kg)</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                           id="quantity" name="quantity" required step="0.01" value="{{ old('quantity', $sale->quantity) }}">
                    @error('quantity')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="price_per_kg" class="form-label">Price per kg</label>
                    <div class="input-group">
                        <span class="input-group-text">KSh</span>
                        <input type="number" class="form-control @error('price_per_kg') is-invalid @enderror"
                               id="price_per_kg" name="price_per_kg" required step="0.01" value="{{ old('price_per_kg', $sale->price_per_kg) }}">
                    </div>
                    @error('price_per_kg')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="discount" class="form-label">Discount</label>
                    <div class="input-group">
                        <span class="input-group-text">KSh</span>
                        <input type="number" class="form-control @error('discount') is-invalid @enderror"
                               id="discount" name="discount" step="0.01" value="{{ old('discount', $sale->discount) }}">
                    </div>
                    @error('discount')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select class="form-control @error('payment_method') is-invalid @enderror"
                            id="payment_method" name="payment_method" required>
                        <option value="cash" {{ old('payment_method', $sale->payment_method) === 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="check" {{ old('payment_method', $sale->payment_method) === 'check' ? 'selected' : '' }}>Check</option>
                        <option value="bank_transfer" {{ old('payment_method', $sale->payment_method) === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="credit" {{ old('payment_method', $sale->payment_method) === 'credit' ? 'selected' : '' }}>Credit</option>
                    </select>
                    @error('payment_method')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <input type="text" class="form-control @error('notes') is-invalid @enderror"
                       id="notes" name="notes" value="{{ old('notes', $sale->notes) }}">
                @error('notes')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Sale
                </button>
                <a href="{{ route('sales.show', $sale) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
