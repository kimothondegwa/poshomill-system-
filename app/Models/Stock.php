<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';
    protected $fillable = [
        'product_name',
        'quantity',
        'cost_per_kg',
        'total_cost',
        'supplier',
        'supplier_phone',
        'batch_number',
        'quality_grade',
        'date_received',
        'expiry_date',
        'notes',
        'added_by',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'cost_per_kg' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'date_received' => 'date',
        'expiry_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who added this stock
     */
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    /**
     * Get stock movements
     */
    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }

    /**
     * Alias for stock movements (compatibility with view)
     */
    public function stockMovements()
    {
        return $this->movements();
    }

    /**
     * Get alerts for this stock
     */
    public function alerts()
    {
        return $this->hasMany(StockAlert::class);
    }

    /**
     * Get total available quantity
     */
    public static function getTotalQuantity()
    {
        return self::sum('quantity');
    }

    /**
     * Get total value
     */
    public static function getTotalValue()
    {
        return self::sum('total_cost');
    }

    /**
     * Check if stock is low
     */
    public function isLow($threshold = 50)
    {
        return $this->quantity <= $threshold;
    }
}
