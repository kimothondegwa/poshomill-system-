@extends('layouts.app')

@section('title', 'Add Stock')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus-circle me-2"></i>Add New Stock</h2>
    <a href="{{ route('stock.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('stock.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                           id="product_name" name="product_name" required value="{{ old('product_name') }}">
                    @error('product_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="batch_number" class="form-label">Batch Number</label>
                    <input type="text" class="form-control @error('batch_number') is-invalid @enderror"
                           id="batch_number" name="batch_number" required value="{{ old('batch_number') }}">
                    @error('batch_number')
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
                    <label for="cost_per_kg" class="form-label">Cost per kg</label>
                    <div class="input-group">
                        <span class="input-group-text">KSh</span>
                        <input type="number" class="form-control @error('cost_per_kg') is-invalid @enderror"
                               id="cost_per_kg" name="cost_per_kg" required step="0.01" value="{{ old('cost_per_kg') }}">
                    </div>
                    @error('cost_per_kg')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="date_received" class="form-label">Date Received</label>
                    <input type="date" class="form-control @error('date_received') is-invalid @enderror"
                           id="date_received" name="date_received" required value="{{ old('date_received') }}">
                    @error('date_received')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="quality_grade" class="form-label">Quality Grade</label>
                    <select class="form-select @error('quality_grade') is-invalid @enderror" id="quality_grade" name="quality_grade" required>
                        <option value="">Select grade</option>
                        <option value="Grade A" {{ old('quality_grade') == 'Grade A' ? 'selected' : '' }}>Grade A</option>
                        <option value="Grade B" {{ old('quality_grade') == 'Grade B' ? 'selected' : '' }}>Grade B</option>
                        <option value="Grade C" {{ old('quality_grade') == 'Grade C' ? 'selected' : '' }}>Grade C</option>
                    </select>
                    @error('quality_grade')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="expiry_date" class="form-label">Expiry Date</label>
                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror"
                           id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
                    @error('expiry_date')
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
                    <i class="fas fa-save me-2"></i>Add Stock
                </button>
                <a href="{{ route('stock.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
