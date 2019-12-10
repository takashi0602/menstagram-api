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
     * @param $userId
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($userId)
    {
        $user = User::where('id', $userId)->first();

        $followIds = collect(Follow::where('user_id', user()->id)->get())->map(function ($v, $k) {
            return $v->target_user_id;
        })->push(user()->id);

        $user = collect($user)->except([
            'deleted_at',
            'created_at',
            'updated_at',
        ]);

        $isFollowed = $followIds->contains($userId) ? true : false;
        $user = $user->put('is_followed', $isFollowed);

        return $user;
    }
}