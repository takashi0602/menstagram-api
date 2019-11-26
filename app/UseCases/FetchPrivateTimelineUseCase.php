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

        if ($postId !== null) {
            $operator = $type === 'new' ? '>' : '<';
            $query->where('id', $operator, $postId);
        }

        $posts = $query
                    ->where('text', '<>', null)
                    ->whereIn('user_id', $followIds)
                    ->orderBy('id', 'desc')
                    ->limit(32)
                    ->get();

        $posts = collect($posts)->reverse()->values()->map(function ($v, $k) {
            return collect($v)->except(['user_id']);
        });

        return $posts;
    }
}