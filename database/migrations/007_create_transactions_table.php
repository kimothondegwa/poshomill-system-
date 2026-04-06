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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ['income', 'expense']);
            $table->enum('category', ['sale', 'stock_purchase', 'salary', 'rent', 'utilities', 'maintenance', 'other']);
            $table->decimal('amount', 10, 2);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->string('reference_type', 50)->nullable();
            $table->enum('payment_method', ['cash', 'mpesa', 'bank', 'cheque'])->default('cash');
            $table->string('payment_reference', 100)->nullable();
            $table->foreignId('recorded_by')->constrained('users')->restrictOnDelete();
            $table->date('transaction_date');
            $table->timestamps();
            
            $table->index('transaction_type');
            $table->index('category');
            $table->index('transaction_date');
            $table->index(['reference_type', 'reference_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
