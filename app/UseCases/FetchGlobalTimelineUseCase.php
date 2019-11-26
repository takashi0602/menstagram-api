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

        if (is_null($postId) && is_null($type))                             $query->latest('id');
        else if (!is_null($postId) && (is_null($type) || $type === 'new'))  $query->where('id', '>=', $postId);
        else if (!is_null($postId) && $type === 'old')                      $query->where('id', '<=', $postId);

        $posts = $query
                    ->limit(32)
                    ->get();

        $posts = collect($posts)->map(function ($v, $k) {
            return collect($v)->except(['user_id']);
        });

        if (is_null($postId) && is_null($type)) $posts = $posts->reverse()->values();

        return $posts;
    }
}