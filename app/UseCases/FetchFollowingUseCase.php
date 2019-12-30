<?php

namespace App\UseCases;

use App\Models\Follow;

/**
 * フォローの取得
 *
 * Class FetchFollowingUseCase
 * @package App\UseCases
 */
class FetchFollowingUseCase
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

        $query = Follow::with(['followingUser'])->where('user_id', $userId);

        if (is_null($followId) && is_null($type))                             $query->latest('id');
        else if (!is_null($followId) && (is_null($type) || $type === 'new'))  $query->where('id', '>=', $followId);
        else if (!is_null($followId) && $type === 'old')                      $query->where('id', '<=', $followId)->orderBy('id', 'desc');

        $following = $query->limit(100)->get();

        $following = collect($following)->map(function ($v, $k) {
            return collect($v->followingUser)->only(['user_id', 'screen_name', 'avatar']);
        });

        if ($type !== 'new') $following = $following->reverse()->values();

        return $following;
    }
}