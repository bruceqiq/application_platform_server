<?php

declare (strict_types=1);

namespace App\Model\Common;

use App\Model\BaseModel;
use Carbon\Carbon;

/**
 * 云服务存储
 * @property int $id
 * @property string $key
 * @property string $app_id
 * @property string $app_secret
 * @property string $name
 * @property string $region
 * @property string $bucket
 * @property string $domain
 * @property string $token
 * @property string $remark
 * @property string $deleted_at
 * @property Carbon $created_at
 * @property int $status
 * @property Carbon $updated_at
 * @property Carbon $expire_time
 */
class CloudStorage extends BaseModel
{
    protected $table = 'cloud_storage_token';

    protected $fillable = [
        'key',
        'app_id',
        'app_secret',
        'name',
        'region',
        'bucket',
        'domain',
        'token',
        'remark',
        'expire_time',
        'cloud_platform_id',
        'status',
    ];

    protected $casts = [
        'id'          => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'expire_time' => 'datetime',
        'status'      => 'integer',
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
        'region',
        'bucket',
        'domain',
        'token',
        'remark',
        'expire_time',
        'cloud_platform_id',
        'created_at',
        'updated_at',
        'cache_time',
        'status',
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
        return strtotime($this->attributes['expire_time']) > time();
    }
}