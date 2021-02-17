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

    /**
     * 查询所有token信息
     * @param array $searchWhere 查询条件
     * @param array $searchFields 查询字段
     * @param int $perSize 分页大小
     * @return array
     */
    public function cloudSelect(array $searchWhere, array $searchFields = ['*'], int $perSize = 10): array
    {
        $items = $this->tokenModel::query()
            ->where($searchWhere)
            ->select($searchFields)
            ->paginate($perSize);

        return [
            'items' => $items->items(),
            'total' => $items->total(),
            'page'  => $items->currentPage(),
            'size'  => $perSize,
        ];
    }
}