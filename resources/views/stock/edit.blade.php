@extends('layouts.app')

@section('title', 'Edit Stock')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-edit me-2"></i>Edit Stock - {{ $stock->product_name }}</h2>
    <a href="{{ route('stock.show', $stock) }}" class="btn btn-secondary">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('stock.update', $stock) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                           id="product_name" name="product_name" required value="{{ old('product_name', $stock->product_name) }}">
                    @error('product_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="batch_number" class="form-label">Batch Number</label>
                    <input type="text" class="form-control @error('batch_number') is-invalid @enderror"
                           id="batch_number" name="batch_number" required value="{{ old('batch_number', $stock->batch_number) }}">
                    @error('batch_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="quantity" class="form-label">Quantity (kg)</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                           id="quantity" name="quantity" required step="0.01" value="{{ old('quantity', $stock->quantity) }}">
                    @error('quantity')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="unit_cost" class="form-label">Unit Cost per kg</label>
                    <div class="input-group">
                        <span class="input-group-text">KSh</span>
                        <input type="number" class="form-control @error('unit_cost') is-invalid @enderror"
                               id="unit_cost" name="unit_cost" required step="0.01" value="{{ old('unit_cost', $stock->unit_cost) }}">
                    </div>
                    @error('unit_cost')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="expiry_date" class="form-label">Expiry Date</label>
                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror"
                           id="expiry_date" name="expiry_date" value="{{ old('expiry_date', $stock->expiry_date?->format('Y-m-d')) }}">
                    @error('expiry_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="supplier" class="form-label">Supplier</label>
                    <input type="text" class="form-control @error('supplier') is-invalid @enderror"
                           id="supplier" name="supplier" value="{{ old('supplier', $stock->supplier) }}">
                    @error('supplier')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control @error('notes') is-invalid @enderror"
                          id="notes" name="notes" rows="3">{{ old('notes', $stock->notes) }}</textarea>
                @error('notes')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Stock
                </button>
                <a href="{{ route('stock.show', $stock) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
