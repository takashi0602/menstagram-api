<?php

namespace App\UseCases;

use App\Models\Like;
use App\Models\Post;

/**
 * 投稿詳細の取得
 *
 * Class FetchPostDetailUseCase
 * @package App\UseCases
 */
class FetchPostDetailUseCase
{
    /**
     * @param $userId
     * @param $postId
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($userId, $postId)
    {
        $response = Post::where('id', $postId)
            ->where('images', '<>', null)
            ->with('user:id,user_id,screen_name,avatar')
            ->first();

        $like = Like::where('user_id', $userId)->where('post_id', $postId)->first();
        $isLiked = true;
        if (collect($like)->isEmpty()) $isLiked = false;
        $response = collect($response)->put('is_liked', $isLiked);

        $response = $response->except(['user_id']);

        return $response;
    }
}