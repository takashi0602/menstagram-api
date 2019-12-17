<?php

namespace App\UseCases;

use App\Models\Like;
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
     * @return Post[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function __invoke($postId = null, $type = null)
    {
        $userId = user()->id;

        $query = Post::with(['user:id,user_id,screen_name,avatar']);

        if (is_null($postId) && is_null($type))                             $query->latest('id');
        else if (!is_null($postId) && (is_null($type) || $type === 'new'))  $query->where('id', '>=', $postId);
        else if (!is_null($postId) && $type === 'old')                      $query->where('id', '<=', $postId)->orderBy('id', 'desc');

        $posts = $query
                    ->limit(10)
                    ->get();

        $posts = collect($posts)->map(function ($v, $k) use ($userId) {
            $like = Like::where('user_id', $userId)->where('post_id', $v->id)->first();
            $isLiked = true;
            if (collect($like)->isEmpty()) $isLiked = false;

            return collect($v)
                        ->map(function ($v, $k) {
                            if ($k === 'user') return collect($v)->except(['id']);
                            return $v;
                        })
                        ->put('is_liked', $isLiked)
                        ->except(['user_id']);
        });

        if ($type !== 'new') $posts = $posts->reverse()->values();

        return $posts;
    }
}