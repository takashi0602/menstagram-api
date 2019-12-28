<?php

namespace App\UseCases;

/**
 * フォロワーの取得
 *
 * Class FetchFollowedUseCase
 * @package App\UseCases
 */
class FetchFollowedUseCase
{
    public function __invoke($userId = null, $followId = null, $type = null)
    {
        $userId = $userId ? $userId : user()->user_id;
    }
}