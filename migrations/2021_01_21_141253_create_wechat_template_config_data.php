<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateWechatTemplateConfigData extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wechat_template_config_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('wechat_template_config_id', false, true)->comment('模板id');
            $table->string('key', 32)->comment('配置key');
            $table->string('value', 20)->comment('配置默认值');
            $table->string('color', 32)->default("#000000")->comment('文字颜色');
            $table->timestamp('deleted_at')->nullable()->comment('删除时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wechat_template_config_data');
    }
}
