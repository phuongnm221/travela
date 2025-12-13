<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            // Add google_id if it doesn't exist
            if (!Schema::hasColumn('tbl_users', 'google_id')) {
                $table->string('google_id')->nullable()->unique()->after('password');
            }
            
            // Add provider if it doesn't exist
            if (!Schema::hasColumn('tbl_users', 'provider')) {
                $table->string('provider')->nullable()->after('google_id');
            }
            
            // Add provider_token if it doesn't exist
            if (!Schema::hasColumn('tbl_users', 'provider_token')) {
                $table->text('provider_token')->nullable()->after('provider');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            if (Schema::hasColumn('tbl_users', 'google_id')) {
                $table->dropColumn('google_id');
            }
            if (Schema::hasColumn('tbl_users', 'provider')) {
                $table->dropColumn('provider');
            }
            if (Schema::hasColumn('tbl_users', 'provider_token')) {
                $table->dropColumn('provider_token');
            }
        });
    }
};
