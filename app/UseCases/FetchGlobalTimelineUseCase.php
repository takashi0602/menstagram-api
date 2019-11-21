<?php

namespace App\UseCases;

use App\Models\Post;

/**
 * グローバルタイムライン
 *
 * Class GlobalTimelineUseCase
 * @package App\UseCases
 */
class FetchGlobalTimelineUseCase
{
    /**
     * @param $postId
     * @return array
     */
    public function __invoke($postId = null)
    {
        if ($postId !== null) {
            $posts = Post::where('id', '<', $postId)
                            ->where('text', '<>', null)
                            ->orderBy('id', 'desc')
                            ->limit(32)
                            ->get();
        } else {
            $posts = Post::where('text', '<>', null)
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