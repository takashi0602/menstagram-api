<?php

namespace App\UseCases;

use App\Models\Post;

/**
 * プライベートタイムライン
 *
 * Class FetchPrivateTimelineUseCase
 * @package App\UseCases
 */
class FetchPrivateTimelineUseCase
{
    /**
     * @param $userId
     * @param null $postId
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($userId, $postId = null)
    {
        if ($postId !== null) {
            // TODO: ここらへんModelに持っていきたい
            $posts = Post::where('id', '<', $postId)
                            ->where('user_id', $userId)
                            ->where('text', '<>', null)
                            ->orderBy('id', 'desc')
                            ->limit(32)
                            ->get();
        } else {
            // TODO: ここらへんModelに持っていきたい
            $posts = Post::where('text', '<>', null)
                            ->where('user_id', $userId)
                            ->orderBy('id', 'desc')
                            ->limit(32)
                            ->get();
        }

        $posts = collect($posts)->map(function ($v, $k) {
            return collect($v)->except(['user_id']);
        });

        return $posts;
    }
}