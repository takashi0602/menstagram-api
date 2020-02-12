<?php

namespace App\UseCases;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        DB::transaction(function () use ($id, $targetId) {
            User::where('id', $id)->decrement('follow_count');
            User::where('id', $targetId)->decrement('follower_count');

            Follow::where('user_id', $id)->where('target_user_id', $targetId)->delete();
        }, 5);

        return true;
    }
}