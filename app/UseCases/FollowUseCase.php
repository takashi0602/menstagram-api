<?php

namespace App\UseCases;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        DB::transaction(function () use ($id, $targetId) {
            User::where('id', $id)->increment('follow_count');
            User::where('id', $targetId)->increment('follower_count');

            Follow::create([
                'user_id'        => $id,
                'target_user_id' => $targetId,
            ]);
        }, 5);

        return true;
    }
}