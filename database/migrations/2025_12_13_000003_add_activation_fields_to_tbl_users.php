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
            // Add activation_token_expires column if it doesn't exist
            if (!Schema::hasColumn('tbl_users', 'activation_token_expires')) {
                $table->timestamp('activation_token_expires')->nullable()->after('activation_token');
            }
            
            // Add is_activated column if it doesn't exist
            if (!Schema::hasColumn('tbl_users', 'is_activated')) {
                $table->boolean('is_activated')->default(false)->after('activation_token_expires');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            if (Schema::hasColumn('tbl_users', 'activation_token_expires')) {
                $table->dropColumn('activation_token_expires');
            }
            if (Schema::hasColumn('tbl_users', 'is_activated')) {
                $table->dropColumn('is_activated');
            }
        });
    }
};
