<?php

declare (strict_types=1);

namespace App\Model\Common;

use App\Model\BaseModel;
use Hyperf\DbConnection\Model\Model;

/**
 * 微信模板消息发送
 * @property int $id
 * @property int $token_id
 * @property string $template_config_id
 * @property string $url
 * @property string $appid
 * @property string $pageth
 * @property string $color
 * @property string $data
 * @property int $send_status
 * @property string $send_message
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $msgid
 */
class WeChatTemplateSend extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wechat_template_send';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token_id',
        'template_config_id',
        'url',
        'appid',
        'pageth',
        'color',
        'data',
        'send_status',
        'send_message',
        'msgid',
        'touser',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'token_id'    => 'integer',
        'send_status' => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'data'        => 'array',
    ];

    // 微信公众号token
    public function token()
    {
        return $this->belongsTo(AppToken::class);
    }

    // 微信模板消息配置
    public function template()
    {
        return $this->belongsTo(WeChatTemplateConfig::class, 'template_config_id', 'id');
    }

    public function getUrlAttribute($key)
    {
        return empty($key) ? '' : $key;
    }

    public function getAppidAttribute($key)
    {
        return empty($key) ? '' : $key;
    }

    public function getPagethAttribute($key)
    {
        return empty($key) ? '' : $key;
    }
}