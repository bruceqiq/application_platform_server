<?php
declare(strict_types=1);

namespace App\Repositories\Common;

use App\Model\Common\CloudPlatform;

/**
 * 云平台
 * Class CloudPlatformRepositories
 * @package App\Repositories\Common
 */
class CloudPlatformRepositories
{
    private $platformModel;

    public function __construct()
    {
        $this->platformModel = new CloudPlatform;
    }

    public function platformSelect(): array
    {
        return $this->platformModel::query()
            ->get($this->platformModel->searchFields)
            ->toArray();
    }
}