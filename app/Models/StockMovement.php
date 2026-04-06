<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $table = 'stock_movements';
    protected $fillable = [
        'stock_id',
        'movement_type',
        'quantity',
        'quantity_before',
        'quantity_after',
        'reference_id',
        'reference_type',
        'notes',
        'moved_by',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'quantity_before' => 'decimal:2',
        'quantity_after' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public $timestamps = false;

    /**
     * Get the stock
     */
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    /**
     * Get the user who made the movement
     */
    public function movedBy()
    {
        return $this->belongsTo(User::class, 'moved_by');
    }
}
