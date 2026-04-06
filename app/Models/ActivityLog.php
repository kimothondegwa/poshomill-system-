<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';
    protected $fillable = [
        'user_id',
        'action',
        'description',
        'table_name',
        'record_id',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = false;

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get logs by user
     */
    public static function byUser($userId)
    {
        return self::where('user_id', $userId)->latest();
    }

    /**
     * Get logs by action
     */
    public static function byAction($action)
    {
        return self::where('action', $action)->latest();
    }
}
