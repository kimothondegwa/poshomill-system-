@extends('layouts.app')

@section('title', 'Sales Report')

@section('content')
<style>
    .sales-hero { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(91, 33, 182, 0.15); }
    .sales-hero h2 { color: white; font-weight: 600; font-size: 1.3rem; margin: 0; }
    .sales-hero .hero-back { display: inline-block; margin-left: auto; }
    .sales-hero .btn { background: white; color: #5b21b6; border: none; font-weight: 600; font-size: 0.9rem; padding: 0.5rem 1rem; transition: all 0.2s; }
    .sales-hero .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }

    .metric-card { background: white; border: none; border-radius: 10px; padding: 1.2rem; margin-bottom: 1.2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: all 0.3s; position: relative; overflow: hidden; }
    .metric-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: #5b21b6; }
    .metric-card:hover { transform: translateY(-4px); box-shadow: 0 6px 16px rgba(0,0,0,0.10); }
    .metric-card .metric-icon { font-size: 1.8rem; margin-bottom: 0.8rem; color: #5b21b6; }
    .metric-card .metric-value { font-size: 1.5rem; font-weight: 700; margin: 0.3rem 0; color: #1f2937; }
    .metric-card .metric-label { color: #6b7280; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.3px; }

    .sales-table-card { background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .sales-table-header { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1rem; color: white; }
    .sales-table-header h5 { margin: 0; font-weight: 600; font-size: 1rem; }
    .table-responsive { border-radius: 0 0 10px 10px; }
    .table { margin-bottom: 0; }
    .table thead th { background: #f3f4f6; color: #374151; font-weight: 600; border: none; padding: 0.75rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.3px; }
    .table tbody tr { transition: background-color 0.2s; border-bottom: 1px solid #e5e7eb; }
    .table tbody tr:hover { background-color: #f9fafb; }
    .table tbody td { padding: 0.75rem; color: #374151; font-size: 0.9rem; }
    .sale-badge { padding: 0.3rem 0.6rem; border-radius: 5px; font-weight: 600; font-size: 0.7rem; }
    .payment-cash { background: #fef3c7; color: #92400e; }
    .payment-card { background: #dbeafe; color: #0369a1; }
    .payment-transfer { background: #e9d5ff; color: #6b21b6; }
    .payment-mpesa { background: #dcfce7; color: #166534; }

    .sale-number { background: #f3e8ff; color: #6b21b6; padding: 0.3rem 0.6rem; border-radius: 4px; font-weight: 600; font-size: 0.8rem; }
    .sale-amount { color: #5b21b6; font-weight: 700; font-size: 0.95rem; }

    .empty-state { text-align: center; padding: 2rem; }
    .empty-state-icon { font-size: 2.5rem; color: #d1d5db; margin-bottom: 0.8rem; }
    .empty-state-text { color: #6b7280; font-size: 0.95rem; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    .metric-card { animation: fadeInUp 0.5s ease-out; }
    .sales-table-card { animation: fadeInUp 0.5s ease-out 0.15s backwards; }

    @media (max-width: 768px) {
        .metric-card { margin-bottom: 0.8rem; }
        .metric-card .metric-value { font-size: 1.3rem; }
    }
</style>

<div class="sales-hero d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="fas fa-chart-line me-2"></i>Sales Report</h2>
    </div>
    <div class="hero-back">
        <a href="{{ route('reports.index') }}" class="btn">← Back</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="metric-card revenue">
            <div class="metric-icon"><i class="fas fa-coins text-success"></i></div>
            <div class="metric-label">Total Revenue</div>
            <div class="metric-value">KSh {{ number_format($sales->sum('final_amount'), 2) }}</div>
            <small class="text-muted">from all sales</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="metric-card quantity">
            <div class="metric-icon"><i class="fas fa-weight text-info"></i></div>
            <div class="metric-label">Total Quantity</div>
            <div class="metric-value">{{ number_format($sales->sum('quantity'), 2) }}</div>
            <small class="text-muted">kg sold</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="metric-card transactions">
            <div class="metric-icon"><i class="fas fa-exchange-alt" style="color: #ec4899;"></i></div>
            <div class="metric-label">Transactions</div>
            <div class="metric-value">{{ $sales->count() }}</div>
            <small class="text-muted">total sales</small>
        </div>
    </div>
</div>

<div class="sales-table-card">
    <div class="sales-table-header">
        <h5><i class="fas fa-list me-2"></i>Recent Sales</h5>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Sale #</th>
                    <th>Customer</th>
                    <th>Quantity</th>
                    <th>Final Amount</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales->take(20) as $sale)
                    <tr>
                        <td><span class="sale-number">#{{ $sale->sale_number }}</span></td>
                        <td><strong>{{ $sale->customer_name }}</strong></td>
                        <td><span class="badge" style="background: #dbeafe; color: #0369a1;">{{ $sale->quantity }} kg</span></td>
                        <td><span class="sale-amount">KSh {{ number_format($sale->final_amount, 2) }}</span></td>
                        <td>
                            @php
                                $method = strtolower($sale->payment_method);
                                $badgeClass = 'payment-' . $method;
                                if (!in_array($method, ['cash', 'card', 'transfer', 'mpesa'])) {
                                    $badgeClass = 'payment-cash';
                                }
                            @endphp
                            <span class="sale-badge {{ $badgeClass }}">
                                <i class="fas
                                    @if(strtolower($sale->payment_method) == 'cash') fa-money-bill-wave
                                    @elseif(strtolower($sale->payment_method) == 'card') fa-credit-card
                                    @elseif(strtolower($sale->payment_method) == 'mpesa') fa-mobile-alt
                                    @else fa-exchange-alt
                                    @endif
                                me-1"></i>{{ ucfirst($sale->payment_method)
                                }}
                            </span>
                        </td>
                        <td>{{ $sale->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="fas fa-receipt"></i></div>
                                <div class="empty-state-text">No sales data available</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
