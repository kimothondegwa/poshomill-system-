<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockAlerts extends Migration
{
    public function up(): void
    {
        Schema::create('stock_alerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_id');
            $table->string('alert_type'); // 'low_stock', 'expiring_soon', etc.
            $table->decimal('quantity_at_alert', 10, 2);
            $table->decimal('threshold_quantity', 10, 2)->default(50); // Default minimum quantity
            $table->text('message');
            $table->string('status')->default('active'); // active, acknowledged, resolved
            $table->timestamp('acknowledged_at')->nullable();
            $table->unsignedBigInteger('acknowledged_by')->nullable();
            $table->timestamps();

            $table->foreign('stock_id')->references('id')->on('stock')->onDelete('cascade');
            $table->foreign('acknowledged_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_alerts');
    }
}
