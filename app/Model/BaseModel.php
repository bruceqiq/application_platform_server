<?php
declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\SoftDeletes;

/**
 * 基础模型
 * Class BaseModel
 * @package App\Model
 */
class BaseModel extends \Hyperf\Database\Model\Model
{
    use SoftDeletes;
}