<?php
declare(strict_types=1);

namespace App\Model\Common;

use App\Model\BaseModel;

/**
 * 云服务
 * Class Cloud
 * @package App\Model\Common
 */
class Cloud extends BaseModel
{
    protected $table = 'cloud';

    protected $fillable = [
        'key',
        'app_id',
        'app_secret',
        'name',
        'region',
        'bucket',
        'domain',
        'remark',
    ];
}