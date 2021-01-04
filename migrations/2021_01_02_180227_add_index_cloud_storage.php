<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AddIndexCloudStorage extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cloud_storage_token', function (Blueprint $table) {
            $table->unique(['cloud_platform_id', 'app_id', 'bucket'], 'idx_app_buck');
            $table->unique('key', 'idx_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cloud_storage', function (Blueprint $table) {
            //
        });
    }
}
