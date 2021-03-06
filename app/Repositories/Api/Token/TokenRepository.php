<?php
declare(strict_types=1);

namespace App\Repositories\Api\Token;

use App\Model\Api\TokenStorage;
use Hyperf\Di\Annotation\Inject;

/**
 * Class TokenRepository
 * @package App\Repositories\Api\Token
 */
class TokenRepository
{
    /**
     * @Inject()
     * @var TokenStorage
     */
    protected $tokenModel;

    public function cloudFind(array $searchWhere): array
    {
        $bean = $this->tokenModel::query()->where($searchWhere)
            ->first(['id', 'cloud_platform_id', 'key', 'app_id', 'app_secret', 'domain', 'cache_time']);

        return !empty($bean) ? $bean->toArray() : [];
    }

    public function cloudUpdate(array $updateInfo, array $updateWhere): bool
    {
        $result = $this->tokenModel::query()->where($updateWhere)->update($updateInfo);

        return $result ? true : false;
    }
}