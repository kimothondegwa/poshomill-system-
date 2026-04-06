<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAlert extends Model
{
    protected $table = 'stock_alerts';

    protected $fillable = [
        'stock_id',
        'alert_type',
        'quantity_at_alert',
        'threshold_quantity',
        'message',
        'status',
        'acknowledged_at',
        'acknowledged_by',
    ];

    protected $casts = [
        'quantity_at_alert' => 'decimal:2',
        'threshold_quantity' => 'decimal:2',
        'acknowledged_at' => 'datetime',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function acknowledgedBy()
    {
        return $this->belongsTo(User::class, 'acknowledged_by');
    }

    public function acknowledge($userId = null)
    {
        $this->update([
            'status' => 'acknowledged',
            'acknowledged_at' => now(),
            'acknowledged_by' => $userId ?? auth()->id(),
        ]);
    }

    public function resolve()
    {
        $this->update(['status' => 'resolved']);
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
}
