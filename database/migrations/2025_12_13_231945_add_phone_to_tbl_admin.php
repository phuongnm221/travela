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
        Schema::table('tbl_admin', function (Blueprint $table) {
            // Add phoneNumber column if it doesn't exist
            if (!Schema::hasColumn('tbl_admin', 'phoneNumber')) {
                $table->string('phoneNumber')->nullable()->after('address');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_admin', function (Blueprint $table) {
            $table->dropColumn('phoneNumber');
        });
    }
};
