<?php

namespace App\UseCases;

use App\Models\Follow;
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
     * @param null $type
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($userId, $postId = null, $type = null)
    {
        $followIds = collect(Follow::where('user_id', $userId)->get())->map(function ($v, $k) {
            return $v->id;
        });

        $query = Post::with(['user:id,screen_name,avatar']);

        if (is_null($postId) && is_null($type))                             $query->latest('id');
        else if (!is_null($postId) && (is_null($type) || $type === 'new'))  $query->where('id', '>=', $postId);
        else if (!is_null($postId) && $type === 'old')                      $query->where('id', '<=', $postId);

        $posts = $query
                    ->whereIn('user_id', $followIds)
                    ->where('text', '<>', null)
                    ->limit(32)
                    ->get();

        $posts = collect($posts)->map(function ($v, $k) {
            return collect($v)->except(['user_id']);
        });

        if (is_null($postId) && is_null($type)) $posts = $posts->reverse()->values();

        return $posts;
    }
}