<?php
declare(strict_types=1);

namespace App\Services\Admin\WeChat;

use App\Repositories\Admin\WeChat\TokenRepositories;

/**
 * 微信
 * Class TokenService
 * @package App\Services\Admin\WeChat
 */
class TokenService
{
    private $tokenRepository;

    public function __construct()
    {
        $this->tokenRepository = new TokenRepositories();
    }

    public function tokenSelect(array $requestParams): array
    {
        $perSize     = $requestParams['size'] ?? 20;
        $searchWhere = [];
        if (!empty($requestParams['name'])) {
            array_push($searchWhere, ['name', 'like', '%' . $requestParams['name'] . '%']);
        }
        return $this->tokenRepository->tokenSelect((array)$searchWhere, (int)$perSize);
    }

    public function tokenCreate(array $requestParams): bool
    {
        return false;
    }

    public function tokenUpdate(array $requestParams): bool
    {
        return false;
    }

    public function tokenDelete(array $requestParams): bool
    {
        return $this->tokenRepository->tokenDelete((array)[['id', '=', $requestParams['id']]]);
    }
}