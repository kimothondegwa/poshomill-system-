<?php $__env->startSection('title', 'Customers'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .customers-hero { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(91, 33, 182, 0.15); display: flex; justify-content: space-between; align-items: center; }
    .customers-hero h2 { color: white; font-weight: 600; font-size: 1.3rem; margin: 0; }
    .customers-hero .btn { background: white; color: #5b21b6; border: none; font-weight: 600; font-size: 0.9rem; padding: 0.5rem 1rem; transition: all 0.2s; }
    .customers-hero .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }

    .success-alert { background: #ecfdf5; color: #166534; border: 1px solid #d1fae5; border-radius: 8px; }
    .success-alert .btn-close { opacity: 0.5; }

    .table-card { background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .table-card-header { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1rem; color: white; }
    .table-card-header h5 { margin: 0; font-weight: 600; font-size: 1rem; }
    .table { margin-bottom: 0; }
    .table thead th { background: #f3f4f6; color: #374151; font-weight: 600; border: none; padding: 0.75rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.3px; }
    .table tbody tr { transition: all 0.2s; border-bottom: 1px solid #e5e7eb; }
    .table tbody tr:hover { background-color: #f9fafb; }
    .table tbody td { padding: 0.75rem; color: #374151; font-size: 0.9rem; }

    .customer-name { font-weight: 700; color: #1f2937; }
    .contact-info { font-size: 0.9rem; color: #6b7280; }
    .location-badge { background: #f3e8ff; color: #6b21b6; padding: 0.3rem 0.6rem; border-radius: 5px; font-weight: 600; font-size: 0.75rem; }

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

<div class="customers-hero">
    <div>
        <h2><i class="fas fa-users me-2"></i>Customers</h2>
    </div>
    <a href="<?php echo e(route('customers.create')); ?>" class="btn">
        <i class="fas fa-user-plus me-1"></i>New Customer
    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert success-alert alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="table-card">
    <?php if($customers->count() > 0): ?>
        <div class="table-card-header">
            <h5><i class="fas fa-address-book me-1"></i>Customer Directory</h5>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="customer-name"><?php echo e($customer->name); ?></span></td>
                            <td><span class="contact-info"><?php echo e($customer->email ?? 'N/A'); ?></span></td>
                            <td><span class="contact-info"><?php echo e($customer->phone); ?></span></td>
                            <td>
                                <?php if($customer->location): ?>
                                    <span class="location-badge"><?php echo e($customer->location); ?></span>
                                <?php else: ?>
                                    <span class="contact-info">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('customers.show', $customer)); ?>" class="btn action-btn view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('customers.edit', $customer)); ?>" class="btn action-btn edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('customers.destroy', $customer)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn action-btn delete" title="Delete" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <div class="empty-state-icon"><i class="fas fa-inbox"></i></div>
            <p class="empty-state-text">No customers yet. <a href="<?php echo e(route('customers.create')); ?>">Add your first customer</a></p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\posho mili project\posho_mill_laravel\resources\views/customers/index.blade.php ENDPATH**/ ?>