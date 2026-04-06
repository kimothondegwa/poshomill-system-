<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'id_number',
        'notes',
        'total_purchases',
        'total_quantity',
        'last_purchase_date',
        'visit_count',
        'last_visit_at',
    ];

    protected $casts = [
        'total_purchases' => 'decimal:2',
        'total_quantity' => 'decimal:2',
        'last_purchase_date' => 'date',
        'visit_count' => 'integer',
        'last_visit_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get customer's sales
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get total purchases formatted
     */
    public function getTotalPurchasesFormatted()
    {
        return number_format($this->total_purchases, 2);
    }

    /**
     * Get total quantity formatted
     */
    public function getTotalQuantityFormatted()
    {
        return number_format($this->total_quantity, 2);
    }
}
