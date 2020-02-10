<?php

namespace App\UseCases;

use App\Models\Follow;

/**
 * フォロワーの取得
 *
 * Class FetchFollowedUseCase
 * @package App\UseCases
 */
class FetchFollowerUseCase
{
    /**
     * @param null $userId
     * @param null $followId
     * @param null $type
     * @return Follow[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function __invoke($userId = null, $followId = null, $type = null)
    {
        $follower = $this->fetchFollower($userId, $followId, $type);

        $followByLoginUser = $this->fetchFollowByLoginUser()->map(function ($v, $k) {
            return $v->follow->id;
        });

        $follower = collect($follower)->map(function ($v, $k) use ($followByLoginUser) {
            return collect($v->followedUser)
                        ->only(['user_id', 'user_name', 'avatar'])
                        ->put('is_follow', collect($followByLoginUser)->contains($v->follower->id) ? true : false)
                        ->put('is_me', user()->id === $v->follower->id ? true : false);
        });

        return $follower;
    }

    /**
     * フォロワー一覧の取得
     *
     * @param null $userId
     * @param null $followId
     * @param null $type
     * @return \Illuminate\Support\Collection
     */
    private function fetchFollower($userId = null, $followId = null, $type = null)
    {
        $userId = $userId ? user($userId)->id : user()->id;

        $query = Follow::with(['follower'])->where('target_user_id', $userId);

        if (is_null($followId) && is_null($type))                            $query->latest('id');
        else if (!is_null($followId) && (is_null($type) || $type === 'new')) $query->where('id', '>=', $followId);
        else if (!is_null($followId) && $type === 'old')                     $query->where('id', '<=', $followId)->orderBy('id', 'desc');

        $follower = collect($query->limit(100)->get());
        if ($type !== 'new') $follower = $follower->reverse()->values();
        return $follower;
    }

    /**
     * フォロー一覧の取得
     *
     * @return \Illuminate\Support\Collection
     */
    private function fetchFollowByLoginUser()
    {
        return collect(Follow::with(['follow'])->where('user_id', user()->id)->get());
    }
}