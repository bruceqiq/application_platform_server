<?php
declare(strict_types=1);

namespace App\Services\Common;

use App\Repositories\Common\CloudPlatformRepositories;

/**
 * 平台
 * Class CloudPlatformService
 * @package App\Services\Common
 */
class CloudPlatformService
{
    private $platformRepositories;

    public function __construct()
    {
        $this->platformRepositories = new CloudPlatformRepositories;
    }

    public function platformSelect(): array
    {
        return $this->platformRepositories->platformSelect();
    }
}