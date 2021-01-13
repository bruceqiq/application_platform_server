<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateCloudTable extends Migration
{
    public function up(): void
    {
        Schema::create('cloud_storage_token', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('cloud_platform_id', false, true)->comment('平台id');
            $table->char('key', 32)->comment('数据key');
            $table->string('app_id', 255)->comment('平台key');
            $table->string('app_secret', 255)->comment('平台secret');
            $table->string('name', 32)->comment('平台名称');
            $table->string('region', 32)->comment('region名称');
            $table->string('bucket', 32)->comment('bucket名称');
            $table->string('domain', 100)->comment('请求域名');
            $table->string('token', 255)->comment('token');
            $table->tinyInteger('status', false, true)->default(2)->comment('应用状态1禁用2启用');
            $table->timestamp('expire_time', 0)->comment('token 过期时间');
            $table->integer('cache_time', false, true)->default(7200)->comment('token缓存有效期');
            $table->text('remark')->nullable()->comment('备注信息');
            $table->timestamp('deleted_at')->nullable()->comment('删除时间');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cloud');
    }
}
