<?php

namespace App\Http\Controllers;

use App\Models\StockAlert;
use App\Services\StockAlertService;
use Illuminate\Support\Facades\Auth;

class StockAlertController extends Controller
{
    protected $alertService;

    public function __construct(StockAlertService $alertService)
    {
        $this->alertService = $alertService;
    }

    /**
     * Display all alerts
     */
    public function index()
    {
        $alerts = StockAlert::with('stock')
            ->orderBy('status')
            ->latest()
            ->paginate(15);

        $summary = $this->alertService->getAlertSummary();

        return view('alerts.index', compact('alerts', 'summary'));
    }

    /**
     * Display active alerts only
     */
    public function active()
    {
        $alerts = $this->alertService->getActiveAlerts();
        $summary = $this->alertService->getAlertSummary();

        return view('alerts.active', compact('alerts', 'summary'));
    }

    /**
     * Acknowledge an alert
     */
    public function acknowledge(StockAlert $alert)
    {
        $alert->acknowledge(Auth::id());

        return back()->with('success', 'Alert acknowledged successfully');
    }

    /**
     * Resolve an alert
     */
    public function resolve(StockAlert $alert)
    {
        $alert->resolve();

        return back()->with('success', 'Alert resolved successfully');
    }

    /**
     * Check stock levels and create alerts manually
     */
    public function checkLevels()
    {
        $this->alertService->checkStockLevels();
        $this->alertService->checkExpiringStock();

        return back()->with('success', 'Stock check completed. Alerts updated.');
    }

    /**
     * Show alert details
     */
    public function show(StockAlert $alert)
    {
        $alert->load('stock', 'acknowledgedBy');

        return view('alerts.show', compact('alert'));
    }
}
