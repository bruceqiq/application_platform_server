<?php
declare(strict_types=1);

namespace App\Model\Api;

/**
 * 微信模板消息发送历史
 * Class WeChatTemplateSend
 * @package App\Model\Api
 */
class WeChatTemplateSend extends \App\Model\Common\WeChatTemplateSend
{
    /**
     * 列表查询字段
     * @var array
     */
    public $listSearchFields = [
        'id',
        'token_id',
        'template_config_id',
        'url',
        'appid',
        'pageth',
        'color',
        'data',
        'send_status',
        'send_message',
        'created_at',
        'msgid',
        'touser',
    ];
}