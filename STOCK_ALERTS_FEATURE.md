# Stock Alert System - Feature Documentation

## Overview
The **Stock Alert System** is a new inventory management feature that monitors stock levels and automatically generates alerts when stock falls below specified thresholds or is approaching expiration dates.

## Features

### 1. Low Stock Alerts
- Automatically detects when stock quantity falls below a configurable threshold (default: 50 kg)
- Creates alerts for easy visibility and tracking
- Prevents stockouts and ensures timely restocking

### 2. Expiring Stock Alerts
- Monitors expiry dates and generates alerts for stock expiring within 7 days
- Helps prevent usage of expired stock
- Ensures quality control compliance

### 3. Alert Management
- **Active Alerts View**: Display all active alerts requiring attention
- **Acknowledge Function**: Mark alerts as acknowledged when action is taken
- **Resolve Function**: Mark alerts as resolved when stock levels are restored
- **Alert History**: Track all alerts and their status changes

### 4. Dashboard Integration
- Alert summary showing total active alerts
- Breakdown by alert type (low stock vs. expiring)
- Quick access to active alerts

## Files Created

### 1. Migration
- `database/migrations/011_create_stock_alerts_table.php`
  - Creates `stock_alerts` table with all necessary columns
  - Includes relationships to stock and user tables

### 2. Models
- `app/Models/StockAlert.php`
  - Manages alert data and status
  - Methods for acknowledging and resolving alerts

### 3. Services
- `app/Services/StockAlertService.php`
  - Business logic for alert creation and checking
  - Methods for checking stock levels and expiry dates
  - Alert summary generation

### 4. Controllers
- `app/Http/Controllers/StockAlertController.php`
  - Handles alert management routes
  - Methods for listing, acknowledging, and resolving alerts

### 5. Routes
- Added to `routes/web.php`:
  ```php
  // Stock Alerts
  Route::get('/alerts', [StockAlertController::class, 'index'])->name('alerts.index');
  Route::get('/alerts/active', [StockAlertController::class, 'active'])->name('alerts.active');
  Route::get('/alerts/{alert}', [StockAlertController::class, 'show'])->name('alerts.show');
  Route::post('/alerts/check-levels', [StockAlertController::class, 'checkLevels'])->name('alerts.check-levels');
  Route::post('/alerts/{alert}/acknowledge', [StockAlertController::class, 'acknowledge'])->name('alerts.acknowledge');
  Route::post('/alerts/{alert}/resolve', [StockAlertController::class, 'resolve'])->name('alerts.resolve');
  ```

## Usage

### Checking Stock Levels
To manually trigger stock level checks:
```php
POST /alerts/check-levels
```

### Viewing Alerts
- View all alerts: `GET /alerts`
- View active alerts only: `GET /alerts/active`
- View specific alert: `GET /alerts/{alert}`

### Managing Alerts
- Acknowledge alert: `POST /alerts/{alert}/acknowledge`
- Resolve alert: `POST /alerts/{alert}/resolve`

### Using the Service Programmatically
```php
use App\Services\StockAlertService;

$alertService = app(StockAlertService::class);

// Check stock levels
$alertService->checkStockLevels(50); // 50 kg threshold

// Check for expiring stock
$alertService->checkExpiringStock(7); // 7 days before expiry

// Get active alerts
$alerts = $alertService->getActiveAlerts();

// Get alert summary
$summary = $alertService->getAlertSummary();
// Returns: ['total' => 5, 'low_stock' => 3, 'expiring' => 2]
```

## Alert Status Flow
1. **Active**: Alert is new and requires attention
2. **Acknowledged**: Alert has been seen and action is being taken
3. **Resolved**: Issue has been resolved (stock replenished/expired stock removed)

## Database Schema

```sql
CREATE TABLE stock_alerts (
    id BIGINT PRIMARY KEY,
    stock_id BIGINT NOT NULL,
    alert_type VARCHAR(255), -- 'low_stock', 'expiring_soon'
    quantity_at_alert DECIMAL(10,2),
    threshold_quantity DECIMAL(10,2) DEFAULT 50,
    message TEXT,
    status VARCHAR(255) DEFAULT 'active', -- 'active', 'acknowledged', 'resolved'
    acknowledged_at TIMESTAMP NULL,
    acknowledged_by BIGINT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (stock_id) REFERENCES stock(id),
    FOREIGN KEY (acknowledged_by) REFERENCES users(id)
);
```

## Future Enhancements
- Email notifications for critical alerts
- SMS alerts for urgent low stock situations
- Scheduled alert checks via cron jobs
- Auto-reorder functionality based on alert thresholds
- Alert filtering and advanced search
- Export alerts to PDF/CSV
- Email notifications to managers

## Next Steps
1. Run migrations: `php artisan migrate`
2. Create views for alert display (resources/views/alerts/)
3. Add alert buttons to dashboard
4. Configure alerting thresholds in settings
5. Set up scheduled checks via Laravel scheduler (optional)
