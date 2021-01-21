<?php
declare(strict_types=1);

namespace App\Repositories\Admin\Token;

use App\Model\Admin\TokenStorage;
use App\Model\Db\CommonDb;
use Hyperf\Di\Annotation\Inject;

/**
 * Class TokenRepositories
 * @package App\Repositories\Admin\WeChat
 */
class TokenRepository
{
    /**
     * @Inject()
     * @var TokenStorage
     */
    private $tokenModel;

    public function tokenSelect(array $searchWhere, int $perSize): array
    {
        $items = $this->tokenModel::query()
            ->with(['platform:id,name'])
            ->select($this->tokenModel->searchFields)
            ->where($searchWhere)
            ->paginate($perSize);

        return [
            'items' => $items->items(),
            'page'  => $items->currentPage(),
            'size'  => $perSize,
            'total' => $items->total(),
        ];
    }

    public function tokenSelectByWhere(array $searchWhere, array $searchFields = ['*']): array
    {
        return CommonDb::selectByWhere((string)$this->tokenModel->getTable(), (array)$searchWhere, (array)$searchFields);
    }

    public function tokenCreate(array $requestParams): bool
    {
        try {
            $result = $this->tokenModel::query()->create($requestParams);
        } catch (\Exception $exception) {
            $result = false;
        }

        return $result ? true : false;
    }

    public function tokenUpdate(array $requestParams, array $updateWhere): bool
    {
        try {
            $result = $this->tokenModel::query()->where($updateWhere)->update($requestParams);
        } catch (\Exception $exception) {
            $result = false;
        }

        return $result ? true : false;
    }

    public function tokenDelete(array $deleteIdArray): bool
    {
        $result = $this->tokenModel::query()->whereIn('id', $deleteIdArray)->delete();

        return $result ? true : false;
    }

    public function tokenStatus(array $updateWhere, int $status): bool
    {
        $result = $this->tokenModel::query()->whereIn('id', $updateWhere)->update([
            'status' => $status,
        ]);

        return $result ? true : false;
    }
}