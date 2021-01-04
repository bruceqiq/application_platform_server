<?php
declare(strict_types=1);

namespace App\Libs\Token;

/**
 * token
 * Interface TokenInterface
 * @package App\Libs\Token
 */
interface TokenInterface
{
    public function createToken(string $appId, string $appSecret): string;
}