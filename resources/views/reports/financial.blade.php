@extends('layouts.app')

@section('title', 'Financial Report')

@section('content')
<style>
    .financial-hero { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(91, 33, 182, 0.15); display: flex; justify-content: space-between; align-items: center; }
    .financial-hero h2 { color: white; font-weight: 600; font-size: 1.3rem; margin: 0; }
    .financial-hero .btn { background: white; color: #5b21b6; border: none; font-weight: 600; font-size: 0.9rem; padding: 0.5rem 1rem; }

    .financial-stat { background: white; border-radius: 10px; padding: 1.2rem; margin-bottom: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); position: relative; overflow: hidden; transition: all 0.3s; }
    .financial-stat::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: #5b21b6; }
    .financial-stat:hover { transform: translateY(-3px); box-shadow: 0 6px 16px rgba(0,0,0,0.10); }
    .financial-stat .stat-icon { font-size: 1.8rem; margin-bottom: 0.6rem; color: #5b21b6; }
    .financial-stat .stat-value { font-size: 1.5rem; font-weight: 700; margin: 0.3rem 0; color: #1f2937; }
    .financial-stat .stat-label { color: #6b7280; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.3px; }

    .table-card { background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .table-card-header { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1rem; color: white; }
    .table-card-header h5 { margin: 0; font-weight: 600; font-size: 1rem; }
    .table { margin-bottom: 0; }
    .table thead th { background: #f3f4f6; color: #374151; font-weight: 600; border: none; padding: 0.75rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.3px; }
    .table tbody tr { transition: background-color 0.2s; border-bottom: 1px solid #e5e7eb; }
    .table tbody tr:hover { background-color: #f9fafb; }
    .table tbody td { padding: 0.75rem; color: #374151; font-size: 0.9rem; }

    .report-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; }

    @keyframes slideIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    .financial-stat { animation: slideIn 0.5s ease-out; }
    .table-card { animation: slideIn 0.5s ease-out 0.15s backwards; }
</style>

<div class="financial-hero">
    <div>
        <h2><i class="fas fa-money-bill-wave me-2"></i>Financial Report</h2>
    </div>
    <a href="{{ route('reports.index') }}" class="btn">← Back</a>
</div>

<div class="row mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="financial-stat">
            <div class="stat-icon"><i class="fas fa-arrow-up"></i></div>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value" style="font-size: 1.3rem;">KSh {{ number_format($totalRevenue, 2) }}</div>
            <small class="text-muted" style="font-size: 0.8rem;">from sales</small>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="financial-stat">
            <div class="stat-icon"><i class="fas fa-arrow-down"></i></div>
            <div class="stat-label">Total Cost</div>
            <div class="stat-value" style="font-size: 1.3rem;">KSh {{ number_format($totalCost, 2) }}</div>
            <small class="text-muted" style="font-size: 0.8rem;">stock cost</small>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="financial-stat">
            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
            <div class="stat-label">Gross Profit</div>
            <div class="stat-value" style="font-size: 1.3rem;">KSh {{ number_format($grossProfit, 2) }}</div>
            <small class="text-muted" style="font-size: 0.8rem;">profit</small>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="financial-stat">
            <div class="stat-icon"><i class="fas fa-percentage"></i></div>
            <div class="stat-label">Profit Margin</div>
            <div class="stat-value">{{ number_format($profitMargin, 2) }}%</div>
            <small class="text-muted" style="font-size: 0.8rem;">margin</small>
        </div>
    </div>
</div>

<div class="report-grid">
    <div>
        <div class="table-card">
            <div class="table-card-header">
                <h5><i class="fas fa-calendar me-1"></i>Monthly Summary</h5>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Revenue</th>
                            <th>Cost</th>
                            <th>Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3" style="font-size: 0.9rem;">
                                <i class="fas fa-calendar-alt" style="font-size: 2rem; opacity: 0.3; margin-bottom: 0.5rem; display: block;"></i>
                                Monthly data will display here
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>
        <div class="table-card">
            <div class="table-card-header">
                <h5><i class="fas fa-credit-card me-1"></i>Payment Distribution</h5>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Method</th>
                            <th>Count</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3" style="font-size: 0.9rem;">
                                <i class="fas fa-wallet" style="font-size: 2rem; opacity: 0.3; margin-bottom: 0.5rem; display: block;"></i>
                                Payment data will display here
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
