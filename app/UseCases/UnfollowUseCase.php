<?php

namespace App\UseCases;

use App\Models\Follow;

/**
 * アンフォロー
 *
 * Class UnfollowUseCase
 * @package App\UseCases
 */
class UnfollowUseCase
{
    /**
     * @param $targetUserId
     * @return bool
     */
    public function __invoke($targetUserId)
    {
        $id = user()->id;
        $targetId = user($targetUserId)->id;

        if (Follow::where('user_id', $id)->where('target_user_id', $targetId)->doesntExist()) return false;
        if ($id === $targetId) return false;

        Follow::where('user_id', user()->id)->where('target_user_id', user($targetUserId)->id)->delete();

        return true;
    }
}