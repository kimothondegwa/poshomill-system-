<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'sale_number',
        'customer_id',
        'customer_name',
        'customer_phone',
        'quantity',
        'rate_per_kg',
        'amount',
        'discount',
        'final_amount',
        'payment_method',
        'payment_reference',
        'payment_status',
        'notes',
        'processed_by',
        'sale_date',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'rate_per_kg' => 'decimal:2',
        'amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'sale_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user who processed the sale
     */
    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Get receipt
     */
    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    /**
     * Get transaction
     */
    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'reference_id')
            ->where('reference_type', 'sale');
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmount()
    {
        return number_format($this->final_amount, 2);
    }
}
