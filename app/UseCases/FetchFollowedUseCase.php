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
        $userId = $userId ? user($userId)->id : user()->id;

        $query = Follow::with(['followedUser'])->where('target_user_id', $userId);

        if (is_null($followId) && is_null($type))                             $query->latest('id');
        else if (!is_null($followId) && (is_null($type) || $type === 'new'))  $query->where('id', '>=', $followId);
        else if (!is_null($followId) && $type === 'old')                      $query->where('id', '<=', $followId)->orderBy('id', 'desc');

        $followed = $query->limit(100)->get();

        $followed = collect($followed)->map(function ($v, $k) {
            return collect($v->followedUser)->only(['user_id', 'screen_name', 'avatar']);
        });

        return $followed;
    }
}