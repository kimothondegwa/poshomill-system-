

<?php $__env->startSection('title', 'Stock Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-box me-2"></i><?php echo e($stock->product_name); ?></h2>
    <div>
        <a href="<?php echo e(route('stock.edit', $stock)); ?>" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="<?php echo e(route('stock.index')); ?>" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Stock Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Product:</strong> <?php echo e($stock->product_name); ?></p>
                <p><strong>Batch Number:</strong> <?php echo e($stock->batch_number); ?></p>
                <p><strong>Quantity:</strong> <span class="badge bg-success"><?php echo e($stock->quantity); ?> kg</span></p>
                <p><strong>Unit Cost:</strong> KSh <?php echo e(number_format($stock->cost_per_kg, 2)); ?> per kg</p>
                <p><strong>Total Cost:</strong> KSh <?php echo e(number_format($stock->total_cost, 2)); ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Additional Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Expiry Date:</strong>
                    <?php if($stock->expiry_date): ?>
                        <?php if($stock->expiry_date->isPast()): ?>
                            <span class="badge bg-danger"><?php echo e($stock->expiry_date->format('M d, Y')); ?> (Expired)</span>
                        <?php else: ?>
                            <?php echo e($stock->expiry_date->format('M d, Y')); ?>

                        <?php endif; ?>
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </p>
                <p><strong>Supplier:</strong> <?php echo e($stock->supplier ?? 'N/A'); ?></p>
                <p><strong>Added by:</strong> <?php echo e($stock->user->full_name ?? 'N/A'); ?></p>
                <p><strong>Added at:</strong> <?php echo e($stock->created_at->format('M d, Y H:i')); ?></p>
            </div>
        </div>
    </div>
</div>

<?php if($stock->notes): ?>
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Notes</h5>
        </div>
        <div class="card-body">
            <?php echo e($stock->notes); ?>

        </div>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Stock Movements</h5>
    </div>
    <div class="card-body">
        <?php if($stock->stockMovements->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Reference</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $stock->stockMovements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($movement->created_at->format('M d, Y')); ?></td>
                                <td><span class="badge bg-info"><?php echo e(ucfirst($movement->movement_type)); ?></span></td>
                                <td><?php echo e($movement->quantity); ?> kg</td>
                                <td><?php echo e($movement->reference_number ?? 'N/A'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">No stock movements recorded yet.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\posho mili project\posho_mill_laravel\resources\views/stock/show.blade.php ENDPATH**/ ?>