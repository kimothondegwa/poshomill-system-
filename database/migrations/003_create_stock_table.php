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
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->decimal('quantity', 10, 2);
            $table->decimal('cost_per_kg', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->string('supplier', 100)->nullable();
            $table->string('supplier_phone', 20)->nullable();
            $table->string('batch_number', 50)->nullable();
            $table->enum('quality_grade', ['Grade A', 'Grade B', 'Grade C'])->default('Grade A');
            $table->date('date_received');
            $table->date('expiry_date')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('added_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();
            
            $table->index('date_received');
            $table->index('batch_number');
            $table->index('added_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
