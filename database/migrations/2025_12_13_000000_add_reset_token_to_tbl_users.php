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
            // Thêm cột reset_token nếu chưa tồn tại
            if (!Schema::hasColumn('tbl_users', 'reset_token')) {
                $table->string('reset_token', 255)->nullable()->after('activation_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            // Xóa cột reset_token
            if (Schema::hasColumn('tbl_users', 'reset_token')) {
                $table->dropColumn('reset_token');
            }
        });
    }
};
