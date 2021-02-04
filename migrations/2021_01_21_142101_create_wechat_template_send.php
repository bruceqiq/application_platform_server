<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateWechatTemplateSend extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wechat_template_send', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('token_id', false, true)->comment('微信token配置id');
            $table->integer('template_config_id', false, true)->comment('微信模板配置主键id');
            $table->string('url', 255)->nullable()->comment('跳转地址');
            $table->string('touser', 100)->comment('接收者');
            $table->string('appid', 100)->nullable()->comment('跳转小程序appid');
            $table->string('pageth', 255)->nullable()->comment('跳转小程序页面路径');
            $table->string('color', 32)->default("#000000")->comment('模板文字颜色,只能是十六进制');
            $table->json('data')->comment('发送消息');
            $table->string('msgid', 32)->nullable()->comment('微信模板消息发送返回的msgid');
            $table->tinyInteger('send_status', false, true)->default(2)->comment('发送状态1发送成功，2待发送中，3发送失败');
            $table->string('send_message')->nullable()->comment('发送结果描述');
            $table->timestamp('deleted_at')->nullable()->comment('删除时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wechat_template_send');
    }
}
