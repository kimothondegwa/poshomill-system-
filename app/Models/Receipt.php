<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $table = 'receipts';
    protected $fillable = [
        'sale_id',
        'receipt_number',
        'file_path',
        'file_type',
        'is_printed',
        'print_count',
        'last_printed_at',
    ];

    protected $casts = [
        'is_printed' => 'boolean',
        'created_at' => 'datetime',
        'last_printed_at' => 'datetime',
    ];

    public $timestamps = false;

    /**
     * Get the sale
     */
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Mark as printed
     */
    public function markAsPrinted()
    {
        $this->print_count++;
        $this->is_printed = true;
        $this->last_printed_at = now();
        $this->save();
    }
}
