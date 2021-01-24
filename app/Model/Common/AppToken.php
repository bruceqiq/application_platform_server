<?php
declare(strict_types=1);

namespace App\Model\Common;


use App\Model\BaseModel;

/**
 * 第三TOKEN
 * Class WeChatPublicToken
 * @package App\Model\Common
 */
class AppToken extends BaseModel
{
    protected $table = 'token';

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
        'status',
        'cache_time'
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected $appends = [
        'status_text',
        'expire_text',
        'expire_status',
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
        'status',
        'cache_time',
    ];

    public function platform()
    {
        return $this->belongsTo(CloudPlatform::class, 'cloud_platform_id', 'id');
    }

    public function getStatusTextAttribute($key)
    {
        return $this->attributes['status'] == 1 ? '启用' : '禁用';
    }

    public function getExpireTextAttribute($key)
    {
        return $this->status() ? '可用' : '失效';
    }

    public function getExpireStatusAttribute($key)
    {
        return $this->status() ? 1 : 2;
    }

    private function status(): bool
    {
        if (!empty($this->attributes['expire_time'])) {
            return strtotime($this->attributes['expire_time']) > time();
        }
        return false;
    }
}