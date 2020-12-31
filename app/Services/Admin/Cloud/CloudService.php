<?php
declare(strict_types=1);

namespace App\Services\Admin\Cloud;

use App\Repositories\Admin\Cloud\CloudRepositories;
use Hyperf\Di\Annotation\Inject;

/**
 * 云服务
 * Class CloudService
 * @package App\Services\Admin\Cloud
 */
class CloudService
{
    private $cloudRepositories;

    public function __construct()
    {
        $this->cloudRepositories = new CloudRepositories;
    }

    public function cloudSelect(array $requestParams): array
    {
        return $this->cloudRepositories->cloudSelect((array)$requestParams);
    }

    public function cloudStore(array $requestParams): bool
    {
        return $this->cloudRepositories->cloudStore((array)$this->dataFormatter((array)$requestParams));
    }

    public function cloudUpdate(array $requestParams): bool
    {
        return $this->cloudRepositories->cloudUpdate((array)$this->dataFormatter((array)$requestParams));
    }

    public function cloudDelete(array $requestParams): bool
    {
        return $this->cloudRepositories->cloudDelete((array)$requestParams);
    }

    private function dataFormatter(array $requestParams): array
    {
        return [
            'key'        => md5(time()),
            'app_id'     => trim($requestParams['app_id']),
            'app_secret' => trim($requestParams['app_secret']),
            'name'       => $requestParams['name'],
            'region'     => trim($requestParams['region']),
            'bucket'     => trim($requestParams['bucket']),
            'domain'     => trim($requestParams['domain']),
            'remark'     => $requestParams['remark'] ?? '',
        ];
    }
}