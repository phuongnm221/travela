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
            // Add created_at if it doesn't exist
            if (!Schema::hasColumn('tbl_users', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('avatar');
            }
            
            // Add updated_at if it doesn't exist
            if (!Schema::hasColumn('tbl_users', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
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
            if (Schema::hasColumn('tbl_users', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('tbl_users', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
};
