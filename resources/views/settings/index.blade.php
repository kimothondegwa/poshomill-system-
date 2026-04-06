@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-cogs me-2"></i>Settings</h2>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Application Settings</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="app_name" class="form-label">Application Name</label>
                <input type="text" class="form-control @error('app_name') is-invalid @enderror"
                       id="app_name" name="app_name" value="{{ old('app_name', config('app.name', 'Posho Mill')) }}">
                @error('app_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                           id="company_name" name="company_name" value="{{ old('company_name') }}">
                    @error('company_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="company_phone" class="form-label">Company Phone</label>
                    <input type="tel" class="form-control @error('company_phone') is-invalid @enderror"
                           id="company_phone" name="company_phone" value="{{ old('company_phone') }}">
                    @error('company_phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="company_email" class="form-label">Company Email</label>
                    <input type="email" class="form-control @error('company_email') is-invalid @enderror"
                           id="company_email" name="company_email" value="{{ old('company_email') }}">
                    @error('company_email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="company_location" class="form-label">Company Location</label>
                    <input type="text" class="form-control @error('company_location') is-invalid @enderror"
                           id="company_location" name="company_location" value="{{ old('company_location') }}">
                    @error('company_location')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="card mb-4 bg-light">
                <div class="card-header">
                    <h5 class="mb-0">System Configuration</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="low_stock_threshold" class="form-label">Low Stock Threshold (kg)</label>
                            <input type="number" class="form-control @error('low_stock_threshold') is-invalid @enderror"
                                   id="low_stock_threshold" name="low_stock_threshold" value="{{ old('low_stock_threshold', 50) }}" step="1">
                            @error('low_stock_threshold')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="text-muted">Alert when stock falls below this quantity</small>
                        </div>
                        <div class="col-md-6">
                            <label for="expiry_alert_days" class="form-label">Expiry Alert Days</label>
                            <input type="number" class="form-control @error('expiry_alert_days') is-invalid @enderror"
                                   id="expiry_alert_days" name="expiry_alert_days" value="{{ old('expiry_alert_days', 7) }}" step="1">
                            @error('expiry_alert_days')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="text-muted">Alert when stock expires within this many days</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <select class="form-control @error('currency') is-invalid @enderror"
                                id="currency" name="currency">
                            <option value="KES" {{ old('currency') === 'KES' ? 'selected' : '' }}>KES (Kenyan Shilling)</option>
                            <option value="USD" {{ old('currency') === 'USD' ? 'selected' : '' }}>USD (US Dollar)</option>
                        </select>
                        @error('currency')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Settings
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
