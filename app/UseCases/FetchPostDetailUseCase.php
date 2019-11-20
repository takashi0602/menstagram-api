<?php

namespace App\UseCases;

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
     * @param $postId
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($postId)
    {
        $response = Post::where('id', $postId)
            ->where('images', '<>', null)
            ->with('user:id,user_id,screen_name,avatar')
            ->first();

        $response = collect($response)->except(['user_id']);

        return $response;
    }
}