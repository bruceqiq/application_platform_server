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
            $table->integer('id', true, true);
            $table->integer('token_id', false, true)->comment('微信token主键id');
            $table->uuid('key')->comment('唯一key');
            $table->string('name', 32)->comment('配置名称');
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

    // 统一发送内容
    // 'key' => '必填',
    // 'url' => '',
    // 'appid' => '',
    // 'pageth' => '',
    // 'color' => '',
    // 'user' => ['openid1', 'openid2', 'openid3', ...., 'openid4'],
    // 'data' => [
    //    'key1' ['value' => '值1', 'color': "颜色"],
    //    'key2' ['value' => '值2', 'color': "颜色"],
    //    'key3' ['value' => '值3', 'color': "颜色"],
    // ]

    // 独立分发
    //  'key' => '必填',
    //  'data' => [
    //    'openid1' => [
    //        'url' => '',
    //        'appid' => '',
    //        'pageth' => '',
    //        'color' => '',
    //        'data' => [
    //              'key1' => [
    //                 'value' => '值', 
    //                 'color' => '颜色',
    //               ],
    //              'key2' => [
    //                  'value' => '值',
    //                  'color' => '颜色',
    //               ]
    //        ]
    //    ],
    //    'openid2' => [

    //    ],
    //    'openid3' => [

    //    ]
    //  ]
    // 'url' => '',
    // 'appid' => '',
    // 'pageth' => '',
    // 'color' => '',
    // 'user' => ['openid1', 'openid2', 'openid3', ...., 'openid4'],
    // 'data' => [
    //   'key1' => '值1', 'key2' => '值2', 'key3' => '值2', 'openid' => '', 'color' => ''
    // ]
}
