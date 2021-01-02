<?php

declare (strict_types=1);

namespace App\Model\Common;

use App\Model\BaseModel;
use Carbon\Carbon;

/**
 * 平台
 * @property int $id
 * @property string $name
 * @property string $remark
 * @property string $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CloudPlatform extends BaseModel
{
    protected $table = 'cloud_platform';

    protected $casts = [
        'id'         => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public $searchFields = [
        'name',
        'remark',
        'id'
    ];

    public function getRemarkAttribute($key)
    {
        return empty($key) ? '' : $key;
    }
}