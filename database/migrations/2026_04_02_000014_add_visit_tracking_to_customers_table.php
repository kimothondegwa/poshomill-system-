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
        Schema::table('customers', function (Blueprint $table) {
            if (!Schema::hasColumn('customers', 'visit_count')) {
                $table->unsignedBigInteger('visit_count')->default(0)->after('notes');
            }
            if (!Schema::hasColumn('customers', 'last_visit_at')) {
                $table->timestamp('last_visit_at')->nullable()->after('visit_count');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            if (Schema::hasColumn('customers', 'last_visit_at')) {
                $table->dropColumn('last_visit_at');
            }
            if (Schema::hasColumn('customers', 'visit_count')) {
                $table->dropColumn('visit_count');
            }
        });
    }
};