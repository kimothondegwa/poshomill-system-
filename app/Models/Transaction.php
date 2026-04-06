<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = [
        'transaction_type',
        'category',
        'amount',
        'description',
        'reference_id',
        'reference_type',
        'payment_method',
        'payment_reference',
        'recorded_by',
        'transaction_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
        'created_at' => 'datetime',
    ];

    public $timestamps = false;

    /**
     * Get the user who recorded the transaction
     */
    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmount()
    {
        return number_format($this->amount, 2);
    }

    /**
     * Get transactions by date range
     */
    public static function byDateRange($startDate, $endDate)
    {
        return self::whereBetween('transaction_date', [$startDate, $endDate]);
    }
}
