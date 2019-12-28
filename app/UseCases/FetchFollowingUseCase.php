<?php

namespace App\UseCases;

/**
 * フォローの取得
 *
 * Class FetchFollowingUseCase
 * @package App\UseCases
 */
class FetchFollowingUseCase
{
    public function __invoke($userId = null, $followId = null, $type = null)
    {
        $userId = $userId ? $userId : user()->user_id;
    }
}