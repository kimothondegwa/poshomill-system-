

<?php $__env->startSection('title', 'Active Alerts'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-exclamation-triangle me-2"></i>Active Alerts</h2>
    <a href="<?php echo e(route('alerts.index')); ?>" class="btn btn-secondary">All Alerts</a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card bg-danger text-white">
            <div class="card-body text-center">
                <h5 class="card-title">Active Alerts</h5>
                <h2><?php echo e($activeAlerts->count()); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <h5 class="card-title">Require Attention</h5>
                <h2><?php echo e($activeAlerts->where('status', 'active')->count()); ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Active Stock Alerts</h5>
    </div>
    <div class="card-body">
        <?php if($activeAlerts->count() > 0): ?>
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
                        <?php $__currentLoopData = $activeAlerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php if($alert->alert_type === 'low_stock'): ?>
                                        <span class="badge bg-danger">Low Stock</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">Expiring Soon</span>
                                    <?php endif; ?>
                                </td>
                                <td><strong><?php echo e($alert->stock->product_name); ?></strong></td>
                                <td><small><?php echo e(Str::limit($alert->message, 50)); ?></small></td>
                                <td>
                                    <?php if($alert->status === 'active'): ?>
                                        <span class="badge bg-danger">Active</span>
                                    <?php elseif($alert->status === 'acknowledged'): ?>
                                        <span class="badge bg-info">Acknowledged</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Resolved</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?php echo e(route('alerts.show', $alert)); ?>" class="btn btn-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if($alert->status === 'active'): ?>
                                            <form action="<?php echo e(route('alerts.acknowledge', $alert)); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <button class="btn btn-warning btn-sm" title="Acknowledge">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if($alert->status !== 'resolved'): ?>
                                            <form action="<?php echo e(route('alerts.resolve', $alert)); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <button class="btn btn-success btn-sm" title="Resolve">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-success text-center">
                <i class="fas fa-check-circle" style="font-size: 3rem; opacity: 0.3;"></i>
                <p class="mt-3">No active alerts! All stock levels are good.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\posho mili project\posho_mill_laravel\resources\views/alerts/active.blade.php ENDPATH**/ ?>