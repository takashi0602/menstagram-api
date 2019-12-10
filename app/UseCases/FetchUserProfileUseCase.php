<?php

namespace App\UseCases;

use App\Models\Follow;
use App\Models\User;

/**
 * ユーザーのプロフィールの取得
 *
 * Class FetchUserProfileUseCase
 * @package App\UseCases
 */
class FetchUserProfileUseCase
{
    /**
     * @param $fetchUserId
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($fetchUserId)
    {
        $fetchUser = User::where('id', $fetchUserId)->first();
        $loginUserId = user()->id;

        $followIds = collect(Follow::where('user_id', $loginUserId)->get())->map(function ($v, $k) {
            return $v->target_user_id;
        })->push($loginUserId);

        $user = collect($fetchUser)->except([
            'deleted_at',
            'created_at',
            'updated_at',
        ]);

        $isFollowed = $followIds->contains($fetchUserId) ? true : false;
        $user = $user->put('is_followed', $isFollowed);

        return $user;
    }
}