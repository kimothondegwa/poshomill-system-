<?php $__env->startSection('title', 'Reports'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .reports-hero { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(91, 33, 182, 0.15); }
    .reports-hero h2 { color: white; font-weight: 600; font-size: 1.3rem; margin: 0; }

    .report-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
    .report-card { background: white; border-radius: 10px; padding: 1.5rem; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: all 0.3s; text-decoration: none; border-top: 3px solid #5b21b6; }
    .report-card:hover { transform: translateY(-4px); box-shadow: 0 6px 16px rgba(0,0,0,0.10); }
    .report-card-icon { font-size: 2rem; margin-bottom: 0.8rem; color: #5b21b6; }
    .report-card-title { font-weight: 700; font-size: 0.95rem; color: #1f2937; margin-bottom: 0.4rem; }
    .report-card-text { color: #6b7280; font-size: 0.85rem; }

    .export-card { background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .export-card-header { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); padding: 1rem; color: white; }
    .export-card-header h5 { margin: 0; font-weight: 600; font-size: 1rem; }
    .export-card .card-body { padding: 1.5rem; }
    .form-group { margin-bottom: 1rem; }
    .form-label { font-weight: 600; color: #1f2937; margin-bottom: 0.4rem; display: block; font-size: 0.9rem; }
    .form-control { border: 1px solid #e5e7eb; border-radius: 6px; padding: 0.6rem; transition: border-color 0.2s; font-size: 0.9rem; }
    .form-control:focus { border-color: #5b21b6; outline: none; box-shadow: 0 0 0 2px rgba(91, 33, 182, 0.1); }
    .export-btn-group { display: flex; gap: 0.8rem; }
    .export-btn { background: linear-gradient(135deg, #5b21b6 0%, #3730a3 100%); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 6px; font-weight: 600; font-size: 0.9rem; transition: all 0.2s; cursor: pointer; }
    .export-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(91, 33, 182, 0.2); }

    @keyframes slideIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    .report-card { animation: slideIn 0.5s ease-out; }
    .export-card { animation: slideIn 0.5s ease-out 0.2s backwards; }

    @media (max-width: 768px) {
        .report-grid { grid-template-columns: 1fr; }
        .export-btn-group { flex-direction: column; }
    }
</style>

<div class="reports-hero">
    <h2><i class="fas fa-chart-bar me-2"></i>Reports Dashboard</h2>
</div>

<div class="report-grid">
    <a href="<?php echo e(route('reports.sales')); ?>" class="report-card">
        <div class="report-card-icon"><i class="fas fa-shopping-cart"></i></div>
        <div class="report-card-title">Sales Report</div>
        <div class="report-card-text">View sales statistics</div>
    </a>

    <a href="<?php echo e(route('reports.stock')); ?>" class="report-card">
        <div class="report-card-icon"><i class="fas fa-boxes"></i></div>
        <div class="report-card-title">Stock Report</div>
        <div class="report-card-text">Check stock levels</div>
    </a>

    <a href="<?php echo e(route('reports.customers')); ?>" class="report-card">
        <div class="report-card-icon"><i class="fas fa-users"></i></div>
        <div class="report-card-title">Customer Report</div>
        <div class="report-card-text">Customer activity</div>
    </a>

    <a href="<?php echo e(route('reports.financial')); ?>" class="report-card">
        <div class="report-card-icon"><i class="fas fa-money-bill-wave"></i></div>
        <div class="report-card-title">Financial Report</div>
        <div class="report-card-text">Financial summary</div>
    </a>
</div>

<div class="export-card">
    <div class="export-card-header">
        <h5><i class="fas fa-download me-1"></i>Export Reports</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('reports.export')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="report_type" class="form-label">Report Type</label>
                        <select class="form-control" id="report_type" name="report_type" required>
                            <option value="">-- Select --</option>
                            <option value="sales">Sales Report</option>
                            <option value="stock">Stock Report</option>
                            <option value="customers">Customer Report</option>
                            <option value="financial">Financial Report</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="format" class="form-label">Format</label>
                        <select class="form-control" id="format" name="format" required>
                            <option value="">-- Select --</option>
                            <option value="pdf">PDF</option>
                            <option value="csv">CSV</option>
                            <option value="excel">Excel</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="submit" class="form-label">&nbsp;</label>
                        <button type="submit" class="export-btn w-100">
                            <i class="fas fa-download me-1"></i>Export
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\posho mili project\posho_mill_laravel\resources\views/reports/index.blade.php ENDPATH**/ ?>