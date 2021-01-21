<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateWechatTemplateConfig extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wechat_template_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('token_key')->comment('微信token配置key');
            $table->string('template_id', 100)->comment('微信公众平台模板id');
            $table->string('url', 255)->nullable()->comment('跳转地址');
            $table->string('appid', 100)->nullable()->comment('跳转小程序appid');
            $table->string('pageth', 255)->nullable()->comment('跳转小程序页面路径');
            $table->string('color', 32)->default("#000000")->comment('模板文字颜色,只能是十六进制');
            $table->tinyInteger('send_style', false, true)->default(1)->comment('发送频率，1定时发送2指定时间发送');
            $table->string('send_time', 15)->comment('发送方式时间');
            $table->tinyInteger('status', false, true)->default(2)->comment('是否启用,状态1启用2禁用');
            $table->timestamp('deleted_at')->nullable()->comment('删除时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wechat_template_config');
    }
}
