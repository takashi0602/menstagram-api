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
     * @param null $postId
     * @param null $type
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($postId = null, $type = null)
    {
        if ($postId !== null) {
            $operator = $type === 'new' ? '>' : '<';
            $posts = Post::where('id', $operator, $postId)
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