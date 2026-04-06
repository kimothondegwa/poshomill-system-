@extends('layouts.app')

@section('title', 'Create Sale')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus-circle me-2"></i>Create New Sale</h2>
    <a href="{{ route('sales.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                           id="customer_name" name="customer_name" required value="{{ old('customer_name') }}">
                    @error('customer_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="customer_phone" class="form-label">Customer Phone</label>
                    <input type="tel" class="form-control @error('customer_phone') is-invalid @enderror"
                           id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}">
                    @error('customer_phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="quantity" class="form-label">Quantity (kg)</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                           id="quantity" name="quantity" required step="0.01" value="{{ old('quantity') }}">
                    @error('quantity')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="rate_per_kg" class="form-label">Rate per kg (KSh)</label>
                    <input type="number" class="form-control @error('rate_per_kg') is-invalid @enderror"
                           id="rate_per_kg" name="rate_per_kg" required step="0.01" value="{{ old('rate_per_kg') }}">
                    @error('rate_per_kg')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="discount" class="form-label">Discount (KSh)</label>
                    <input type="number" class="form-control @error('discount') is-invalid @enderror"
                           id="discount" name="discount" step="0.01" value="{{ old('discount', 0) }}">
                    @error('discount')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select class="form-control @error('payment_method') is-invalid @enderror"
                            id="payment_method" name="payment_method" required>
                        <option value="">Select Payment Method</option>
                        <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="mpesa" {{ old('payment_method') === 'mpesa' ? 'selected' : '' }}>M-Pesa</option>
                        <option value="bank" {{ old('payment_method') === 'bank' ? 'selected' : '' }}>Bank</option>
                        <option value="credit" {{ old('payment_method') === 'credit' ? 'selected' : '' }}>Credit</option>
                    </select>
                    @error('payment_method')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="payment_reference" class="form-label">Payment Reference</label>
                    <input type="text" class="form-control @error('payment_reference') is-invalid @enderror"
                           id="payment_reference" name="payment_reference" value="{{ old('payment_reference') }}">
                    @error('payment_reference')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control @error('notes') is-invalid @enderror"
                          id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                @error('notes')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Create Sale
                </button>
                <a href="{{ route('sales.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
