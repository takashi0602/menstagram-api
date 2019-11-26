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
        $query = Post::with(['user:id,screen_name,avatar']);

        if ($postId !== null) {
            $operator = $type === 'new' ? '>' : '<';
            $query->where('id', $operator, $postId);
        }

        $posts = $query
                    ->where('text', '<>', null)
                    ->orderBy('id', 'desc')
                    ->limit(32)
                    ->get();

        $posts = collect($posts)->reverse()->values()->map(function ($v, $k) {
            return collect($v)->except(['user_id']);
        });

        return $posts;
    }
}