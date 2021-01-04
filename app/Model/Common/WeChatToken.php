<?php
declare(strict_types=1);

namespace App\Model\Common;


use App\Model\BaseModel;

/**
 * 微信
 * Class WeChatPublicToken
 * @package App\Model\Common
 */
class WeChatToken extends BaseModel
{
    protected $table = 'wechat_token';

    protected $fillable = [
        'cloud_platform_id',
        'key',
        'app_id',
        'app_secret',
        'name',
        'domain',
        'token',
        'expire_time',
        'remark',
    ];

    public $searchFields = [
        'id',
        'key',
        'app_id',
        'app_secret',
        'name',
        'domain',
        'token',
        'remark',
        'expire_time',
        'cloud_platform_id',
        'created_at',
        'updated_at',
    ];

    public function platform()
    {
        return $this->belongsTo(CloudPlatform::class, 'cloud_platform_id', 'id');
    }
}