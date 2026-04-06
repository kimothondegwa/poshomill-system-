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
        Schema::table('stock', function (Blueprint $table) {
            if (!Schema::hasColumn('stock', 'product_name')) {
                $table->string('product_name', 100)->after('id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock', function (Blueprint $table) {
            if (Schema::hasColumn('stock', 'product_name')) {
                $table->dropColumn('product_name');
            }
        });
    }
};