<?php

namespace App\UseCases;

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
        $response = Like::where('post_id', $postId)
                            ->with(['user'])
                            ->orderBy('id', 'desc')
                            ->limit(100)
                            ->get();

        $response = collect($response)->map(function ($v, $k) {
            return [
                'user_id'      => $v['user']['user_id'],
                'screen_name'  => $v['user']['user_id'],
                'avatar'       => $v['user']['avatar'],
                'is_following' => true,
            ];
        });

        return $response;
    }
}