<?php

declare (strict_types=1);

namespace App\Model\Common;

use App\Model\BaseModel;
use Carbon\Carbon;

/**
 * 微信模板消息配置数据
 * @property int $id
 * @property int $wechat_template_config_id
 * @property string $key_name
 * @property string $key_value
 * @property string $key_color
 * @property int $status
 * @property string $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class WeChatTemplateConfigData extends BaseModel
{
    protected $table = 'wechat_template_config_data';

    protected $fillable = [
        'wechat_template_config_id',
        'key_name',
        'key_value',
        'key_color',
        'status',
    ];

    protected $casts = [
        'id'                        => 'integer',
        'wechat_template_config_id' => 'integer',
        'status'                    => 'integer',
        'created_at'                => 'datetime',
        'updated_at'                => 'datetime'
    ];

    public function config()
    {
        return $this->belongsTo(WeChatTemplateConfig::class);
    }
}