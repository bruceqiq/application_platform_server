<?php

declare (strict_types=1);

namespace App\Model\Common;

use App\Model\BaseModel;

/**
 * 微信模板消息配置
 * @property int $id
 * @property int $token_id
 * @property string $key
 * @property string $name
 * @property string $template_id
 * @property string $url
 * @property string $appid
 * @property string $pageth
 * @property string $color
 * @property int $send_style
 * @property string $send_time
 * @property int $status
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class WeChatTemplateConfig extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wechat_template_config';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token_id',
        'key',
        'name',
        'template_id',
        'url',
        'appid',
        'pageth',
        'color',
        'send_style',
        'send_time',
        'status',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'token_id'   => 'integer',
        'send_style' => 'integer',
        'status'     => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'status_text',
    ];

    public function token()
    {
        return $this->belongsTo(AppToken::class)->with(['platform:id,name']);
    }

    public function getStatusTextAttribute($key)
    {
        return $this->attributes['status'] == 1 ? '启用' : '禁用';
    }
}