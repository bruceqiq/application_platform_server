<?php
declare(strict_types=1);

namespace App\Repositories\Admin\Token;

use App\Model\Admin\TokenStorage;

/**
 * 微信
 * Class TokenRepositories
 * @package App\Repositories\Admin\WeChat
 */
class TokenRepository
{
    private $tokenModel;

    public function __construct()
    {
        $this->tokenModel = new TokenStorage();
    }

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

    public function tokenDelete(array $deleteWhere): bool
    {
        $result = $this->tokenModel::query()->where($deleteWhere)->delete();

        return $result ? true : false;
    }
}