<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;
use Hyperf\DbConnection\Db;

class CreateCloudTable extends Migration
{
    public function up(): void
    {
        Schema::create('cloud_storage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key', 32)->comment('数据key');
            $table->string('app_id', 255)->comment('平台key');
            $table->string('app_secret', 255)->comment('平台secret');
            $table->string('name', 32)->comment('平台名称');
            $table->string('region', 32)->comment('region名称');
            $table->string('bucket', 32)->comment('bucket名称');
            $table->string('domain', 100)->comment('请求域名');
            $table->text('remark')->nullable()->comment('备注信息');
            $table->timestamp('deleted_at')->comment('删除时间');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cloud');
    }
}
