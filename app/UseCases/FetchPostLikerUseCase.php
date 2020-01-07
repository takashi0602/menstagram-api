<?php

namespace App\UseCases;

use App\Models\Follow;
use App\Models\Like;

/**
 * いいねしたユーザー一覧の取得
 *
 * Class FetchPostLikerUseCase
 * @package App\UseCases
 */
class FetchPostLikerUseCase
{
    /**
     * @param $postId
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($postId)
    {
        $likes = Like::where('post_id', $postId)
                        ->with(['user'])
                        ->orderBy('id', 'desc')
                        ->limit(100)
                        ->get();

        $userIds = [];
        foreach ($likes as $like) {
            $userIds[] = $like->user->id;
        }

        $follows = Follow::where('user_id', user()->id)
                            ->whereIn('target_user_id', $userIds)
                            ->get();

        $followIds = collect($follows)->map(function ($v, $k) {
            return $v->target_user_id;
        });

        $response = collect($likes)->map(function ($v, $k) use ($followIds) {
            return [
                'user_id'      => $v['user']['user_id'],
                'screen_name'  => $v['user']['user_id'],
                'avatar'       => $v['user']['avatar'],
                'is_following' => collect($followIds)->contains($v['user']['id']) ? true : false,
            ];
        });

        return $response;
    }
}