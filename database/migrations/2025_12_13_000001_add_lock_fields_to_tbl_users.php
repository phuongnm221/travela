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
        Schema::table('tbl_users', function (Blueprint $table) {
            if (!Schema::hasColumn('tbl_users', 'failed_attempts')) {
                $table->integer('failed_attempts')->default(0)->after('activation_token');
            }
            if (!Schema::hasColumn('tbl_users', 'lock_until')) {
                $table->timestamp('lock_until')->nullable()->after('failed_attempts');
            }
            if (!Schema::hasColumn('tbl_users', 'lock_level')) {
                $table->tinyInteger('lock_level')->default(0)->after('lock_until');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            if (Schema::hasColumn('tbl_users', 'failed_attempts')) {
                $table->dropColumn('failed_attempts');
            }
            if (Schema::hasColumn('tbl_users', 'lock_until')) {
                $table->dropColumn('lock_until');
            }
            if (Schema::hasColumn('tbl_users', 'lock_level')) {
                $table->dropColumn('lock_level');
            }
        });
    }
};
