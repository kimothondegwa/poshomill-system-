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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales')->cascadeOnDelete();
            $table->string('receipt_number', 50)->unique();
            $table->string('file_path', 255)->nullable();
            $table->enum('file_type', ['pdf', 'html'])->default('pdf');
            $table->boolean('is_printed')->default(false);
            $table->integer('print_count')->default(0);
            $table->dateTime('last_printed_at')->nullable();
            $table->timestamps();
            
            $table->index('receipt_number');
            $table->index('sale_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
