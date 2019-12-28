<?php

namespace App\UseCases;

use App\Models\Follow;

/**
 * フォロー
 *
 * Class FollowUseCase
 * @package App\UseCases
 */
class FollowUseCase
{
    /**
     * @param $targetUserId
     * @return bool
     */
    public function __invoke($targetUserId)
    {
        $id = user()->id;
        $targetId = user($targetUserId)->id;

        if (Follow::where('user_id', $id)->where('target_user_id', $targetId)->exists()) return false;
        if ($id === $targetId) return false;

        Follow::create([
            'user_id'        => $id,
            'target_user_id' => $targetId,
        ]);

        return true;
    }
}