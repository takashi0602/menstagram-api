<?php

namespace App\UseCases;

use App\Models\Follow;

/**
 * フォロワーの取得
 *
 * Class FetchFollowedUseCase
 * @package App\UseCases
 */
class FetchFollowedUseCase
{
    /**
     * @param null $userId
     * @param null $followId
     * @param null $type
     * @return Follow[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function __invoke($userId = null, $followId = null, $type = null)
    {
        $followed = $this->fetchFollowedUsers($userId, $followId, $type);

        $followingByLoginUser = $this->fetchFollowingUsersByLoginUser()->map(function ($v, $k) {
            return $v->followingUser->id;
        });

        $followed = collect($followed)->map(function ($v, $k) use ($followingByLoginUser) {
            return collect($v->followedUser)
                        ->only(['user_id', 'screen_name', 'avatar'])
                        ->put('is_following', collect($followingByLoginUser)->contains($v->followedUser->id) ? true : false)
                        ->put('is_me', user()->id === $v->followedUser->id ? true : false);
        });

        return $followed;
    }

    /**
     * フォロワー一覧の取得
     *
     * @param null $userId
     * @param null $followId
     * @param null $type
     * @return \Illuminate\Support\Collection
     */
    private function fetchFollowedUsers($userId = null, $followId = null, $type = null)
    {
        $userId = $userId ? user($userId)->id : user()->id;

        $query = Follow::with(['followedUser'])->where('target_user_id', $userId);

        if (is_null($followId) && is_null($type))                            $query->latest('id');
        else if (!is_null($followId) && (is_null($type) || $type === 'new')) $query->where('id', '>=', $followId);
        else if (!is_null($followId) && $type === 'old')                     $query->where('id', '<=', $followId)->orderBy('id', 'desc');

        $followed = collect($query->limit(100)->get());
        if ($type !== 'new') $followed = $followed->reverse()->values();
        return $followed;
    }

    /**
     * フォロー一覧の取得
     *
     * @return \Illuminate\Support\Collection
     */
    private function fetchFollowingUsersByLoginUser()
    {
        return collect(Follow::with(['followingUser'])->where('user_id', user()->id)->get());
    }
}