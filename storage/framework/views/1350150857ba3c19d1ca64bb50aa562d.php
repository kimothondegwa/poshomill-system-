

<?php $__env->startSection('title', 'Sale Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-receipt me-2"></i>Sale #<?php echo e($sale->sale_number); ?></h2>
    <div>
        <a href="<?php echo e(route('sales.edit', $sale)); ?>" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="<?php echo e(route('sales.index')); ?>" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Sale Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Sale Number:</strong> <?php echo e($sale->sale_number); ?></p>
                <p><strong>Customer:</strong> <?php echo e($sale->customer_name); ?></p>
                <p><strong>Sale Date:</strong> <?php echo e($sale->sale_date->format('M d, Y')); ?></p>
                <p><strong>Stock:</strong> <?php echo e(optional($sale->stock)->product_name ?? 'N/A'); ?></p>
                <p><strong>Quantity:</strong> <?php echo e($sale->quantity); ?> kg</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Payment Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Price per kg:</strong> KSh <?php echo e(number_format($sale->price_per_kg, 2)); ?></p>
                <p><strong>Subtotal:</strong> KSh <?php echo e(number_format($sale->subtotal, 2)); ?></p>
                <p><strong>Discount:</strong> KSh <?php echo e(number_format($sale->discount, 2)); ?></p>
                <p><strong class="text-success">Final Amount:</strong> <span class="h5">KSh <?php echo e(number_format($sale->final_amount, 2)); ?></span></p>
                <p><strong>Payment Method:</strong> <span class="badge bg-info"><?php echo e(ucfirst(str_replace('_', ' ', $sale->payment_method))); ?></span></p>
            </div>
        </div>
    </div>
</div>

<?php if($sale->notes): ?>
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Notes</h5>
        </div>
        <div class="card-body">
            <?php echo e($sale->notes); ?>

        </div>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Additional Details</h5>
    </div>
    <div class="card-body">
        <p><strong>Created by:</strong> <?php echo e($sale->user->full_name ?? 'N/A'); ?></p>
        <p><strong>Created at:</strong> <?php echo e($sale->created_at->format('M d, Y H:i')); ?></p>
        <?php if($sale->updated_at->ne($sale->created_at)): ?>
            <p><strong>Updated at:</strong> <?php echo e($sale->updated_at->format('M d, Y H:i')); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\posho mili project\posho_mill_laravel\resources\views/sales/show.blade.php ENDPATH**/ ?>