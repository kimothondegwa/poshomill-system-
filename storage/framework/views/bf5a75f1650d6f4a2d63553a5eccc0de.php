<?php $__env->startSection('title', 'Customer Report'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .customers-report-hero { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(91, 33, 182, 0.15); display: flex; justify-content: space-between; align-items: center; }
    .customers-report-hero h2 { color: white; font-weight: 600; font-size: 1.3rem; margin: 0; }
    .customers-report-hero .btn { background: white; color: #5b21b6; border: none; font-weight: 600; font-size: 0.9rem; padding: 0.5rem 1rem; }

    .stat-card { background: white; border-radius: 10px; padding: 1.2rem; margin-bottom: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); position: relative; overflow: hidden; }
    .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: #5b21b6; }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 6px 16px rgba(0,0,0,0.10); }
    .stat-card .stat-icon { font-size: 1.8rem; margin-bottom: 0.6rem; color: #5b21b6; }
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

    .empty-state { text-align: center; padding: 2rem; }
    .empty-state-icon { font-size: 2.5rem; color: #d1d5db; margin-bottom: 0.8rem; }
    .empty-state-text { color: #6b7280; font-size: 0.95rem; }

    @keyframes slideIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    .stat-card { animation: slideIn 0.5s ease-out; }
    .table-card { animation: slideIn 0.5s ease-out 0.15s backwards; }
</style>

<div class="customers-report-hero">
    <div>
        <h2><i class="fas fa-users me-2"></i>Customer Report</h2>
    </div>
    <a href="<?php echo e(route('reports.index')); ?>" class="btn">← Back</a>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-label">Total Customers</div>
            <div class="stat-value"><?php echo e($totalCustomers); ?></div>
            <small class="text-muted" style="font-size: 0.8rem;">registered</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user-check"></i></div>
            <div class="stat-label">Active Customers</div>
            <div class="stat-value"><?php echo e($activeCustomers); ?></div>
            <small class="text-muted" style="font-size: 0.8rem;">with purchases</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-coins"></i></div>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value" style="font-size: 1.3rem;">KSh <?php echo e(number_format($totalRevenue, 2)); ?></div>
            <small class="text-muted" style="font-size: 0.8rem;">from customers</small>
        </div>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <h5><i class="fas fa-chart-bar me-1"></i>Top Customers by Sales</h5>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Purchases</th>
                    <th>Total</th>
                    <th>Last Purchase</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="text-center text-muted py-3" style="font-size: 0.9rem;">
                        <i class="fas fa-chart-area" style="font-size: 2rem; opacity: 0.3; margin-bottom: 0.5rem; display: block;"></i>
                        Customer data will be displayed here
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\posho mili project\posho_mill_laravel\resources\views/reports/customers.blade.php ENDPATH**/ ?>