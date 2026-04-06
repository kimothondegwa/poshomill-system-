<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\StockAlert;

class StockAlertService
{
    /**
     * Check stock levels and create alerts if needed
     */
    public function checkStockLevels($thresholdQuantity = 50)
    {
        $stocks = Stock::where('quantity', '<', $thresholdQuantity)->get();

        foreach ($stocks as $stock) {
            // Check if an active alert already exists
            $existingAlert = StockAlert::where('stock_id', $stock->id)
                ->where('alert_type', 'low_stock')
                ->where('status', 'active')
                ->first();

            // Create alert if none exists
            if (!$existingAlert) {
                $batchNumber = $stock->batch_number ?? 'N/A';
                StockAlert::create([
                    'stock_id' => $stock->id,
                    'alert_type' => 'low_stock',
                    'quantity_at_alert' => $stock->quantity,
                    'threshold_quantity' => $thresholdQuantity,
                    'message' => "Stock level low: {$stock->quantity} kg remaining (Batch: {$batchNumber})",
                    'status' => 'active',
                ]);
            }
        }
    }

    /**
     * Check for expiring stock
     */
    public function checkExpiringStock($daysBeforeExpiry = 7)
    {
        $expiryDate = now()->addDays($daysBeforeExpiry);

        $stocks = Stock::whereNotNull('expiry_date')
            ->whereBetween('expiry_date', [now(), $expiryDate])
            ->get();

        foreach ($stocks as $stock) {
            $existingAlert = StockAlert::where('stock_id', $stock->id)
                ->where('alert_type', 'expiring_soon')
                ->where('status', 'active')
                ->first();

            if (!$existingAlert) {
                $batchNumber = $stock->batch_number ?? 'N/A';
                $expiryDate = $stock->expiry_date->format('Y-m-d');
                StockAlert::create([
                    'stock_id' => $stock->id,
                    'alert_type' => 'expiring_soon',
                    'quantity_at_alert' => $stock->quantity,
                    'threshold_quantity' => 0,
                    'message' => "Stock expiring soon: {$batchNumber} expires on {$expiryDate}",
                    'status' => 'active',
                ]);
            }
        }
    }

    /**
     * Get all active alerts
     */
    public function getActiveAlerts()
    {
        return StockAlert::where('status', 'active')
            ->with('stock')
            ->latest()
            ->get();
    }

    /**
     * Get alert summary for dashboard
     */
    public function getAlertSummary()
    {
        $activeAlerts = StockAlert::where('status', 'active')->count();
        $lowStockAlerts = StockAlert::where('status', 'active')
            ->where('alert_type', 'low_stock')
            ->count();
        $expiringAlerts = StockAlert::where('status', 'active')
            ->where('alert_type', 'expiring_soon')
            ->count();

        return [
            'total' => $activeAlerts,
            'low_stock' => $lowStockAlerts,
            'expiring' => $expiringAlerts,
        ];
    }
}
