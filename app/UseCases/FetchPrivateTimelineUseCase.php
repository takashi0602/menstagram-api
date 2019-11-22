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
     * @param null $type
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($userId, $postId = null, $type = null)
    {
        if ($postId !== null) {
            $operator = $type === 'new' ? '>' : '<';
            // TODO: ここらへんModelに持っていきたい
            $posts = Post::where('id', $operator, $postId)
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

        $posts = collect($posts)->reverse()->values()->map(function ($v, $k) {
            return collect($v)->except(['user_id']);
        });

        return $posts;
    }
}