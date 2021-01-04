<?php
declare(strict_types=1);

namespace App\Services\Common;

use App\Repositories\Common\CloudPlatformRepository;
use Hyperf\Di\Annotation\Inject;

/**
 * 平台
 * Class CloudPlatformService
 * @package App\Services\Common
 */
class CloudPlatformService
{
    /**
     * @Inject()
     * @var CloudPlatformRepository
     */
    protected $platformRepositories;

    public function platformSelect(): array
    {
        return $this->platformRepositories->platformSelect();
    }
}