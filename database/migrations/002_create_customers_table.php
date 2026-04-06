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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 20);
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('id_number', 20)->nullable();
            $table->text('notes')->nullable();
            $table->decimal('total_purchases', 10, 2)->default(0);
            $table->decimal('total_quantity', 10, 2)->default(0);
            $table->date('last_purchase_date')->nullable();
            $table->timestamps();
            
            $table->index('phone');
            $table->index('name');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
