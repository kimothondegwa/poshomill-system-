<?php $__env->startSection('title', 'Alerts'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .alerts-hero { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(91, 33, 182, 0.15); display: flex; justify-content: space-between; align-items: center; }
    .alerts-hero h2 { color: white; font-weight: 600; font-size: 1.3rem; margin: 0; }
    .alerts-hero .btn { background: white; color: #5b21b6; border: none; font-weight: 600; font-size: 0.9rem; padding: 0.5rem 1rem; transition: all 0.2s; }
    .alerts-hero .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }

    .success-alert { background: #ecfdf5; color: #166534; border: 1px solid #d1fae5; border-radius: 8px; }
    .success-alert .btn-close { opacity: 0.5; }

    .stat-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
    .stat-card-alert { background: white; border-radius: 10px; padding: 1rem; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border-top: 3px solid; }
    .stat-card-alert.active { border-top-color: #5b21b6; }
    .stat-card-alert.low-stock { border-top-color: #5b21b6; }
    .stat-card-alert.expiring { border-top-color: #5b21b6; }
    .stat-card-alert.resolved { border-top-color: #5b21b6; }
    .stat-card-alert-label { color: #6b7280; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.4rem; }
    .stat-card-alert-value { font-size: 1.8rem; font-weight: 700; color: #1f2937; }

    .table-card { background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .table-card-header { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1rem; color: white; display: flex; justify-content: space-between; align-items: center; }
    .table-card-header h5 { margin: 0; font-weight: 600; font-size: 1rem; }
    .table-card-header-link { color: white; background: rgba(255,255,255,0.2); padding: 0.4rem 0.8rem; border-radius: 5px; font-weight: 600; text-decoration: none; font-size: 0.85rem; transition: all 0.2s; }
    .table-card-header-link:hover { background: rgba(255,255,255,0.3); }
    .table { margin-bottom: 0; }
    .table thead th { background: #f3f4f6; color: #374151; font-weight: 600; border: none; padding: 0.75rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.3px; }
    .table tbody tr { transition: all 0.2s; border-bottom: 1px solid #e5e7eb; }
    .table tbody tr:hover { background-color: #f9fafb; }
    .table tbody td { padding: 0.75rem; color: #374151; font-size: 0.9rem; }

    .alert-type { padding: 0.3rem 0.6rem; border-radius: 5px; font-weight: 600; font-size: 0.7rem; }
    .alert-type-low { background: #fee2e2; color: #991b1b; }
    .alert-type-expiring { background: #fef3c7; color: #92400e; }

    .alert-status { padding: 0.3rem 0.6rem; border-radius: 10px; font-weight: 600; font-size: 0.7rem; }
    .status-active { background: #fee2e2; color: #991b1b; }
    .status-acknowledged { background: #dbeafe; color: #0369a1; }
    .status-resolved { background: #dcfce7; color: #166534; }

    .action-btn { border: none; padding: 0.3rem 0.5rem; border-radius: 5px; transition: all 0.2s; margin: 0 1px; font-size: 0.8rem; }
    .action-btn:hover { transform: translateY(-1px); box-shadow: 0 2px 8px rgba(0,0,0,0.12); }
    .action-btn.view { background: #dbeafe; color: #0369a1; }
    .action-btn.check { background: #fef3c7; color: #92400e; }
    .action-btn.resolve { background: #dcfce7; color: #166534; }

    .empty-state { text-align: center; padding: 2rem; }
    .empty-state-icon { font-size: 2.5rem; color: #d1d5db; margin-bottom: 0.8rem; }
    .empty-state-text { color: #6b7280; font-size: 0.95rem; }

    @keyframes slideIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    .table-card { animation: slideIn 0.5s ease-out; }
</style>

<div class="alerts-hero">
    <div>
        <h2><i class="fas fa-bell me-2"></i>Stock Alerts</h2>
    </div>
    <button class="btn" data-bs-toggle="modal" data-bs-target="#checkAlertsModal">
        <i class="fas fa-sync me-1"></i>Check Levels
    </button>
</div>

<?php if(session('success')): ?>
    <div class="alert success-alert alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="stat-cards">
    <div class="stat-card-alert active">
        <div class="stat-card-alert-label">Active Alerts</div>
        <div class="stat-card-alert-value"><?php echo e($alerts->where('status', 'active')->count()); ?></div>
    </div>
    <div class="stat-card-alert low-stock">
        <div class="stat-card-alert-label">Low Stock</div>
        <div class="stat-card-alert-value"><?php echo e($alerts->where('alert_type', 'low_stock')->count()); ?></div>
    </div>
    <div class="stat-card-alert expiring">
        <div class="stat-card-alert-label">Expiring Soon</div>
        <div class="stat-card-alert-value"><?php echo e($alerts->where('alert_type', 'expiring_soon')->count()); ?></div>
    </div>
    <div class="stat-card-alert resolved">
        <div class="stat-card-alert-label">Resolved</div>
        <div class="stat-card-alert-value"><?php echo e($alerts->where('status', 'resolved')->count()); ?></div>
    </div>
</div>

<div class="table-card">
    <div class="table-card-header">
        <h5><i class="fas fa-exclamation-circle me-2"></i>All Alerts</h5>
        <a href="<?php echo e(route('alerts.active')); ?>" class="table-card-header-link">View Active Only</a>
    </div>
    <?php if($alerts->count() > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Product</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php if($alert->alert_type === 'low_stock'): ?>
                                    <span class="alert-type alert-type-low">Low Stock</span>
                                <?php else: ?>
                                    <span class="alert-type alert-type-expiring">Expiring</span>
                                <?php endif; ?>
                            </td>
                            <td><strong><?php echo e($alert->stock->product_name); ?></strong></td>
                            <td><small class="text-muted"><?php echo e(Str::limit($alert->message, 40)); ?></small></td>
                            <td>
                                <span class="alert-status <?php if($alert->status === 'active'): ?> status-active <?php elseif($alert->status === 'acknowledged'): ?> status-acknowledged <?php else: ?> status-resolved <?php endif; ?>">
                                    <?php if($alert->status === 'active'): ?>
                                        Active
                                    <?php elseif($alert->status === 'acknowledged'): ?>
                                        Ack
                                    <?php else: ?>
                                        Resolved
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td><small><?php echo e($alert->created_at->format('M d, Y')); ?></small></td>
                            <td>
                                <a href="<?php echo e(route('alerts.show', $alert)); ?>" class="btn action-btn view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if($alert->status === 'active'): ?>
                                    <form action="<?php echo e(route('alerts.acknowledge', $alert)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn action-btn check" title="Acknowledge">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <?php if($alert->status !== 'resolved'): ?>
                                    <form action="<?php echo e(route('alerts.resolve', $alert)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn action-btn resolve" title="Resolve">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <div class="empty-state-icon"><i class="fas fa-check-circle"></i></div>
            <p class="empty-state-text">No alerts. All stock levels are good!</p>
        </div>
    <?php endif; ?>
</div>

<!-- Check Alerts Modal -->
<div class="modal fade" id="checkAlertsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); color: white; border: none;">
                <h5 class="modal-title" style="font-size: 0.95rem;"><i class="fas fa-cog me-1"></i>Check Stock Levels</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);"></button>
            </div>
            <form action="<?php echo e(route('alerts.check-levels')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body" style="padding: 1.5rem;">
                    <div class="mb-2">
                        <label for="threshold_quantity" class="form-label" style="font-size: 0.9rem;">Low Stock Threshold (kg)</label>
                        <input type="number" class="form-control" id="threshold_quantity" name="threshold_quantity" value="50" step="1" style="border-radius: 6px; font-size: 0.9rem;">
                        <small class="text-muted" style="font-size: 0.8rem;">Alert if stock falls below this</small>
                    </div>
                    <div class="mb-2">
                        <label for="days_before_expiry" class="form-label" style="font-size: 0.9rem;">Days Before Expiry</label>
                        <input type="number" class="form-control" id="days_before_expiry" name="days_before_expiry" value="7" step="1" style="border-radius: 6px; font-size: 0.9rem;">
                        <small class="text-muted" style="font-size: 0.8rem;">Alert if expires within days</small>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e5e7eb;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-size: 0.9rem;">Cancel</button>
                    <button type="submit" class="btn" style="background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); color: white; border: none; font-size: 0.9rem;">Check Levels</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\posho mili project\posho_mill_laravel\resources\views/alerts/index.blade.php ENDPATH**/ ?>