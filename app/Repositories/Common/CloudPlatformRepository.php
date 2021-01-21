<?php
declare(strict_types=1);

namespace App\Repositories\Common;

use App\Model\Common\CloudPlatform;
use Hyperf\Di\Annotation\Inject;

/**
 * Class CloudPlatformRepositories
 * @package App\Repositories\Common
 */
class CloudPlatformRepository
{
    /**
     * @Inject()
     * @var CloudPlatform
     */
    protected $platformModel;

    public function platformSelect(): array
    {
        return $this->platformModel::query()
            ->get($this->platformModel->searchFields)
            ->toArray();
    }
}