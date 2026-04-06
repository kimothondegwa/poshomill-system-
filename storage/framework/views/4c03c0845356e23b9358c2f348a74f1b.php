

<?php $__env->startSection('title', 'Stock Report'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .stock-hero { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(91, 33, 182, 0.15); }
    .stock-hero h2 { color: white; font-weight: 600; font-size: 1.3rem; margin: 0; }
    .stock-hero .hero-back { display: inline-block; margin-left: auto; }
    .stock-hero .btn { background: white; color: #5b21b6; border: none; font-weight: 600; font-size: 0.9rem; padding: 0.5rem 1rem; transition: all 0.2s; }
    .stock-hero .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }

    .stat-card { background: white; border: none; border-radius: 10px; padding: 1.2rem; margin-bottom: 1.2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: all 0.3s; position: relative; overflow: hidden; }
    .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: #5b21b6; }
    .stat-card:hover { transform: translateY(-4px); box-shadow: 0 6px 16px rgba(0,0,0,0.10); }
    .stat-card .stat-icon { font-size: 1.8rem; margin-bottom: 0.8rem; color: #5b21b6; }
    .stat-card .stat-value { font-size: 1.5rem; font-weight: 700; margin: 0.3rem 0; color: #1f2937; }
    .stat-card .stat-label { color: #6b7280; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.3px; }

    .table-card { background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .table-card-header { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1rem; color: white; }
    .table-card-header h5 { margin: 0; font-weight: 600; font-size: 1rem; }
    .table { margin-bottom: 0; }
    .table thead th { background: #f3f4f6; color: #374151; font-weight: 600; border: none; padding: 0.75rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.3px; }
    .table tbody tr { transition: background-color 0.2s; border-bottom: 1px solid #e5e7eb; }
    .table tbody tr:hover { background-color: #f9fafb; }
    .table tbody td { padding: 0.75rem; color: #374151; font-size: 0.9rem; }
    .badge { padding: 0.4rem 0.7rem; border-radius: 6px; font-weight: 600; font-size: 0.75rem; }
    .badge.bg-success { background: #e0f2fe; color: #0369a1; }
    .badge.bg-danger { background: #fee2e2; color: #991b1b; }

    .empty-state { text-align: center; padding: 2rem; }
    .empty-state-icon { font-size: 2.5rem; color: #d1d5db; margin-bottom: 0.8rem; }
    .empty-state-text { color: #6b7280; font-size: 0.95rem; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    .stat-card { animation: fadeInUp 0.5s ease-out; }
    .table-card { animation: fadeInUp 0.5s ease-out 0.15s backwards; }

    @media (max-width: 768px) {
        .stat-card { margin-bottom: 0.8rem; }
        .stat-card .stat-value { font-size: 1.3rem; }
    }
</style>

<div class="stock-hero d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="fas fa-boxes me-2"></i>Stock Report</h2>
    </div>
    <div class="hero-back">
        <a href="<?php echo e(route('reports.index')); ?>" class="btn">← Back</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card success">
            <div class="stat-icon"><i class="fas fa-cube text-success"></i></div>
            <div class="stat-label">Total Stock</div>
            <div class="stat-value"><?php echo e(number_format($totalStock, 2)); ?></div>
            <small class="text-muted">kg available</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card info">
            <div class="stat-icon"><i class="fas fa-money-bill-wave text-primary"></i></div>
            <div class="stat-label">Stock Value</div>
            <div class="stat-value">KSh <?php echo e(number_format($totalStockValue, 2)); ?></div>
            <small class="text-muted">total cost</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card primary">
            <div class="stat-icon"><i class="fas fa-cube text-primary" style="color: #8b5cf6 !important;"></i></div>
            <div class="stat-label">Products</div>
            <div class="stat-value"><?php echo e($totalProducts); ?></div>
            <small class="text-muted">unique items</small>
        </div>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <h5><i class="fas fa-table me-2"></i>Stock Levels by Product</h5>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th>Total Value</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $stock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong><?php echo e($item->product_name ?? 'N/A'); ?></strong></td>
                        <td><span class="badge" style="background: #dbeafe; color: #0369a1;"><?php echo e(number_format($item->quantity, 2)); ?> kg</span></td>
                        <td>KSh <?php echo e(number_format($item->cost_per_kg, 2)); ?></td>
                        <td><strong>KSh <?php echo e(number_format($item->total_cost, 2)); ?></strong></td>
                        <td>
                            <?php if($item->expiry_date && $item->expiry_date->isPast()): ?>
                                <span class="badge bg-danger"><i class="fas fa-exclamation-circle me-1"></i>Expired</span>
                            <?php else: ?>
                                <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Active</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="fas fa-box-open"></i></div>
                                <div class="empty-state-text">No stock records available</div>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\posho mili project\posho_mill_laravel\resources\views/reports/stock.blade.php ENDPATH**/ ?>