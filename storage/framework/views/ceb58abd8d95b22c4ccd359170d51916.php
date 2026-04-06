

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<style>
    :root {
        --primary-color: #00b894;
        --secondary-color: #0984e3;
        --accent-color: #fd79a8;
        --dark-color: #2d3436;
    }

    /* Page Header */
    .dashboard-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .dashboard-header h2 {
        margin: 0;
        font-weight: 700;
        font-size: 2rem;
    }

    .dashboard-header p {
        margin: 10px 0 0 0;
        opacity: 0.95;
        font-size: 1.1rem;
    }

    /* Stat Cards */
    .stat-card {
        border: none;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .stat-card .card-body {
        position: relative;
        z-index: 1;
        padding: 0;
    }

    .stat-card .card-title {
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 15px;
        opacity: 0.9;
    }

    .stat-card h2 {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0;
        line-height: 1;
    }

    .stat-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 3rem;
        opacity: 0.2;
    }

    /* Custom Card Colors */
    .card-primary-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .card-success-custom {
        background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
        color: white;
    }

    .card-info-custom {
        background: linear-gradient(135deg, #0984e3 0%, #74b9ff 100%);
        color: white;
    }

    .card-warning-custom {
        background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
        color: white;
    }

    /* Table Card */
    .table-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .table-card .card-header {
        background: white;
        border-bottom: 2px solid #f1f3f5;
        padding: 20px 25px;
    }

    .table-card .card-header h5 {
        margin: 0;
        font-weight: 700;
        color: var(--dark-color);
    }

    .table-card .card-body {
        padding: 0;
    }

    .table-hover tbody tr {
        transition: all 0.2s ease;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
    }

    .table {
        margin: 0;
    }

    .table thead th {
        background: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        color: #6c757d;
        padding: 15px 20px;
    }

    .table tbody td {
        padding: 15px 20px;
        vertical-align: middle;
    }

    .table tbody td a {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .table tbody td a:hover {
        color: var(--secondary-color);
        text-decoration: underline;
    }

    /* Quick Actions Card */
    .quick-actions-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        height: 100%;
    }

    .quick-actions-card .card-header {
        background: white;
        border-bottom: 2px solid #f1f3f5;
        padding: 20px 25px;
    }

    .quick-actions-card .card-header h5 {
        margin: 0;
        font-weight: 700;
        color: var(--dark-color);
    }

    .quick-actions-card .card-body {
        padding: 25px;
    }

    .action-btn {
        border: none;
        border-radius: 12px;
        padding: 15px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .action-btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
    }

    .btn-success-custom {
        background: linear-gradient(135deg, #00b894, #00cec9);
        color: white;
    }

    .btn-info-custom {
        background: linear-gradient(135deg, #0984e3, #74b9ff);
        color: white;
    }

    .btn-secondary-custom {
        background: linear-gradient(135deg, #636e72, #2d3436);
        color: white;
    }

    .action-btn i {
        font-size: 1.2rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.3;
        color: var(--primary-color);
    }

    .empty-state p {
        font-size: 1.1rem;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-header h2 {
            font-size: 1.5rem;
        }
        
        .stat-card h2 {
            font-size: 1.8rem;
        }

        .stat-icon {
            font-size: 2rem;
        }
    }
</style>

<div class="dashboard-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2><i class="fas fa-tachometer-alt me-3"></i>Dashboard</h2>
            <p>Welcome back, <strong><?php echo e(Auth::user()->full_name); ?></strong>! Here's what's happening today.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <small><?php echo e(now()->format('l, F d, Y')); ?></small>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card card-primary-custom">
            <div class="card-body">
                <h5 class="card-title">Total Sales</h5>
                <h2>KSh <?php echo e(number_format($totalSales, 2)); ?></h2>
                <i class="fas fa-chart-line stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card card-success-custom">
            <div class="card-body">
                <h5 class="card-title">Current Stock</h5>
                <h2><?php echo e(number_format($currentStock, 2)); ?> kg</h2>
                <i class="fas fa-boxes stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card card-info-custom">
            <div class="card-body">
                <h5 class="card-title">Total Customers</h5>
                <h2><?php echo e($totalCustomers); ?></h2>
                <i class="fas fa-users stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card card-warning-custom">
            <div class="card-body">
                <h5 class="card-title">Today's Sales</h5>
                <h2><?php echo e($activeSales); ?></h2>
                <i class="fas fa-shopping-cart stat-icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card table-card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5><i class="fas fa-receipt me-2"></i>Recent Sales</h5>
                    <a href="<?php echo e(route('sales.index')); ?>" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
            </div>
            <div class="card-body">
                <?php if($recentSales->count() > 0): ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag me-1"></i>Sale #</th>
                                <th><i class="fas fa-user me-1"></i>Customer</th>
                                <th><i class="fas fa-weight me-1"></i>Quantity</th>
                                <th><i class="fas fa-money-bill-wave me-1"></i>Amount</th>
                                <th><i class="fas fa-calendar me-1"></i>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $recentSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="<?php echo e(route('sales.show', $sale)); ?>"><?php echo e($sale->sale_number); ?></a></td>
                                    <td><?php echo e($sale->customer_name); ?></td>
                                    <td><span class="badge bg-success"><?php echo e($sale->quantity); ?> kg</span></td>
                                    <td><strong>KSh <?php echo e(number_format($sale->final_amount, 2)); ?></strong></td>
                                    <td><small class="text-muted"><?php echo e($sale->sale_date->format('M d, Y')); ?></small></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>No sales recorded yet. Start by creating your first sale!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card quick-actions-card">
            <div class="card-header">
                <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <a href="<?php echo e(route('sales.create')); ?>" class="btn action-btn btn-primary-custom w-100 mb-3">
                    <i class="fas fa-plus-circle"></i>
                    <span>New Sale</span>
                </a>
                <a href="<?php echo e(route('stock.create')); ?>" class="btn action-btn btn-success-custom w-100 mb-3">
                    <i class="fas fa-box"></i>
                    <span>Add Stock</span>
                </a>
                <a href="<?php echo e(route('customers.create')); ?>" class="btn action-btn btn-info-custom w-100 mb-3">
                    <i class="fas fa-user-plus"></i>
                    <span>New Customer</span>
                </a>
                <a href="<?php echo e(route('reports.index')); ?>" class="btn action-btn btn-secondary-custom w-100">
                    <i class="fas fa-chart-bar"></i>
                    <span>View Reports</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\posho mili project\posho_mill_laravel\resources\views/dashboard.blade.php ENDPATH**/ ?>