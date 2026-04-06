<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_number', 50)->unique();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->setNullOnDelete();
            $table->string('customer_name');
            $table->string('customer_phone', 20)->nullable();
            $table->decimal('quantity', 10, 2);
            $table->decimal('rate_per_kg', 10, 2);
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('final_amount', 10, 2);
            $table->enum('payment_method', ['cash', 'mpesa', 'bank', 'credit'])->default('cash');
            $table->string('payment_reference', 100)->nullable();
            $table->enum('payment_status', ['paid', 'pending', 'partial'])->default('paid');
            $table->text('notes')->nullable();
            $table->foreignId('processed_by')->constrained('users')->restrictOnDelete();
            $table->date('sale_date');
            $table->timestamps();
            
            $table->index('sale_number');
            $table->index('customer_id');
            $table->index('sale_date');
            $table->index('processed_by');
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
