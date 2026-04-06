@extends('layouts.app')

@section('title', 'Alert Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-bell me-2"></i>Alert #{{ $alert->id }}</h2>
    <a href="{{ route('alerts.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Alert Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Alert Type:</strong>
                    @if ($alert->alert_type === 'low_stock')
                        <span class="badge bg-danger">Low Stock</span>
                    @else
                        <span class="badge bg-warning">Expiring Soon</span>
                    @endif
                </p>
                <p><strong>Product:</strong> {{ $alert->stock->product_name }}</p>
                <p><strong>Quantity at Alert:</strong> {{ $alert->quantity_at_alert }} kg</p>
                <p><strong>Threshold Quantity:</strong> {{ $alert->threshold_quantity }} kg</p>
                <p><strong>Status:</strong>
                    @if ($alert->status === 'active')
                        <span class="badge bg-danger">Active</span>
                    @elseif ($alert->status === 'acknowledged')
                        <span class="badge bg-info">Acknowledged</span>
                    @else
                        <span class="badge bg-success">Resolved</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Timeline</h5>
            </div>
            <div class="card-body">
                <p><strong>Created:</strong><br>
                    <small>{{ $alert->created_at->format('M d, Y H:i') }}</small>
                </p>
                @if ($alert->acknowledged_at)
                    <p><strong>Acknowledged:</strong><br>
                        <small>{{ $alert->acknowledged_at->format('M d, Y H:i') }}</small><br>
                        <small>By: {{ $alert->acknowledgedBy?->full_name ?? 'N/A' }}</small>
                    </p>
                @endif
                @if ($alert->updated_at->ne($alert->created_at))
                    <p><strong>Last Updated:</strong><br>
                        <small>{{ $alert->updated_at->format('M d, Y H:i') }}</small>
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Message</h5>
    </div>
    <div class="card-body">
        {{ $alert->message }}
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Actions</h5>
    </div>
    <div class="card-body">
        <div class="btn-group" role="group">
            @if ($alert->status === 'active')
                <form action="{{ route('alerts.acknowledge', $alert) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-check me-2"></i>Acknowledge Alert
                    </button>
                </form>
            @endif
            @if ($alert->status !== 'resolved')
                <form action="{{ route('alerts.resolve', $alert) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-times me-2"></i>Resolve Alert
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
