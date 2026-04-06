@extends('layouts.app')

@section('title', 'Stock Management')

@section('content')
<style>
    .stock-hero { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(91, 33, 182, 0.15); display: flex; justify-content: space-between; align-items: center; }
    .stock-hero h2 { color: white; font-weight: 600; font-size: 1.3rem; margin: 0; }
    .stock-hero .btn { background: white; color: #5b21b6; border: none; font-weight: 600; font-size: 0.9rem; padding: 0.5rem 1rem; transition: all 0.2s; }
    .stock-hero .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }

    .success-alert { background: #ecfdf5; color: #166534; border: 1px solid #d1fae5; border-radius: 8px; }
    .success-alert .btn-close { opacity: 0.5; }

    .table-card { background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .table-card-header { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1rem; color: white; }
    .table-card-header h5 { margin: 0; font-weight: 600; font-size: 1rem; }
    .table { margin-bottom: 0; }
    .table thead th { background: #f3f4f6; color: #374151; font-weight: 600; border: none; padding: 0.75rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.3px; }
    .table tbody tr { transition: background-color 0.2s; border-bottom: 1px solid #e5e7eb; }
    .table tbody tr:hover { background-color: #f9fafb; }
    .table tbody td { padding: 0.75rem; color: #374151; font-size: 0.9rem; }

    .qty-badge { padding: 0.4rem 0.7rem; border-radius: 6px; font-weight: 600; font-size: 0.75rem; }
    .qty-low { background: #fee2e2; color: #991b1b; }
    .qty-high { background: #dcfce7; color: #166534; }
    .grade-badge { padding: 0.3rem 0.6rem; border-radius: 5px; background: #f3f4f6; color: #374151; font-weight: 600; font-size: 0.75rem; }

    .action-btn { border: none; padding: 0.4rem 0.6rem; border-radius: 5px; transition: all 0.2s; margin: 0 2px; font-size: 0.85rem; }
    .action-btn:hover { transform: translateY(-1px); box-shadow: 0 2px 8px rgba(0,0,0,0.12); }
    .action-btn.view { background: #dbeafe; color: #0369a1; }
    .action-btn.edit { background: #fef3c7; color: #92400e; }
    .action-btn.delete { background: #fee2e2; color: #991b1b; }

    .empty-state { text-align: center; padding: 2rem; }
    .empty-state-icon { font-size: 2.5rem; color: #d1d5db; margin-bottom: 0.8rem; }
    .empty-state-text { color: #6b7280; font-size: 0.95rem; }
    .empty-state a { color: #5b21b6; font-weight: 600; text-decoration: none; }

    @keyframes slideIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    .table-card { animation: slideIn 0.5s ease-out; }
</style>

<div class="stock-hero">
    <div>
        <h2><i class="fas fa-boxes me-2"></i>Stock Management</h2>
    </div>
    <a href="{{ route('stock.create') }}" class="btn">
        <i class="fas fa-plus me-1"></i>Add Stock
    </a>
</div>

@if (session('success'))
    <div class="alert success-alert alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="table-card">
    @if ($stock->count() > 0)
        <div class="table-card-header">
            <h5><i class="fas fa-list me-1"></i>Stock Inventory</h5>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Batch #</th>
                        <th>Grade</th>
                        <th>Cost/kg</th>
                        <th>Received</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stock as $item)
                        <tr>
                            <td>
                                <span class="qty-badge @if ($item->quantity <= 50) qty-low @else qty-high @endif">
                                    {{ $item->quantity }} kg
                                </span>
                            </td>
                            <td><strong>{{ $item->batch_number ?? 'N/A' }}</strong></td>
                            <td><span class="grade-badge">{{ $item->quality_grade }}</span></td>
                            <td>KSh {{ number_format($item->cost_per_kg, 2) }}</td>
                            <td>{{ $item->date_received->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('stock.show', $item) }}" class="btn action-btn view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('stock.edit', $item) }}" class="btn action-btn edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('stock.destroy', $item) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn action-btn delete" title="Delete" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon"><i class="fas fa-inbox"></i></div>
            <p class="empty-state-text">No stock available. <a href="{{ route('stock.create') }}">Add your first stock</a></p>
        </div>
    @endif
</div>
@endsection
