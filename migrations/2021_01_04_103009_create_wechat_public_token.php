<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateWechatPublicToken extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('app_token', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('cloud_platform_id', false, true)->comment('平台id');
            $table->char('key', 32)->comment('数据key');
            $table->string('app_id', 255)->comment('平台key');
            $table->string('app_secret', 255)->comment('平台secret');
            $table->string('name', 32)->comment('平台名称');
            $table->string('domain', 100)->comment('请求域名');
            $table->string('token', 255)->comment('token');
            $table->timestamp('expire_time', 0)->comment('token过期时间');
            $table->integer('cache_time', false, true)->default(7200)->comment('token缓存有效期');
            $table->text('remark')->nullable()->comment('备注信息');
            $table->timestamp('deleted_at')->nullable()->comment('删除时间');
            $table->timestamps();
            $table->unique(['cloud_platform_id', 'app_id'], 'idx_app');
            $table->unique('key', 'idx_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wechat_public_token');
    }
}
