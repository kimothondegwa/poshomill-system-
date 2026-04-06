@extends('layouts.app')

@section('title', 'Active Alerts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-exclamation-triangle me-2"></i>Active Alerts</h2>
    <a href="{{ route('alerts.index') }}" class="btn btn-secondary">All Alerts</a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card bg-danger text-white">
            <div class="card-body text-center">
                <h5 class="card-title">Active Alerts</h5>
                <h2>{{ $activeAlerts->count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <h5 class="card-title">Require Attention</h5>
                <h2>{{ $activeAlerts->where('status', 'active')->count() }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Active Stock Alerts</h5>
    </div>
    <div class="card-body">
        @if ($activeAlerts->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-exclamation-triangle me-1"></i>Alert Type</th>
                            <th><i class="fas fa-box me-1"></i>Product</th>
                            <th><i class="fas fa-comment me-1"></i>Message</th>
                            <th><i class="fas fa-flag me-1"></i>Status</th>
                            <th><i class="fas fa-cogs me-1"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeAlerts as $alert)
                            <tr>
                                <td>
                                    @if ($alert->alert_type === 'low_stock')
                                        <span class="badge bg-danger">Low Stock</span>
                                    @else
                                        <span class="badge bg-warning">Expiring Soon</span>
                                    @endif
                                </td>
                                <td><strong>{{ $alert->stock->product_name }}</strong></td>
                                <td><small>{{ Str::limit($alert->message, 50) }}</small></td>
                                <td>
                                    @if ($alert->status === 'active')
                                        <span class="badge bg-danger">Active</span>
                                    @elseif ($alert->status === 'acknowledged')
                                        <span class="badge bg-info">Acknowledged</span>
                                    @else
                                        <span class="badge bg-success">Resolved</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('alerts.show', $alert) }}" class="btn btn-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if ($alert->status === 'active')
                                            <form action="{{ route('alerts.acknowledge', $alert) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button class="btn btn-warning btn-sm" title="Acknowledge">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($alert->status !== 'resolved')
                                            <form action="{{ route('alerts.resolve', $alert) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button class="btn btn-success btn-sm" title="Resolve">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-success text-center">
                <i class="fas fa-check-circle" style="font-size: 3rem; opacity: 0.3;"></i>
                <p class="mt-3">No active alerts! All stock levels are good.</p>
            </div>
        @endif
    </div>
</div>
@endsection
