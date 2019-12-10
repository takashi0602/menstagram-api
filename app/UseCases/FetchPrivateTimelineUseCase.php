<?php

namespace App\UseCases;

use App\Models\Follow;
use App\Models\Like;
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
     * @return Post[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function __invoke($userId, $postId = null, $type = null)
    {
        $followIds = collect(Follow::where('user_id', $userId)->get())->map(function ($v, $k) {
            return $v->target_user_id;
        })->push($userId);

        $query = Post::with(['user:id,screen_name,avatar']);

        if (is_null($postId) && is_null($type))                             $query->latest('id');
        else if (!is_null($postId) && (is_null($type) || $type === 'new'))  $query->where('id', '>=', $postId);
        else if (!is_null($postId) && $type === 'old')                      $query->where('id', '<=', $postId);

        $posts = $query
                    ->whereIn('user_id', $followIds)
                    ->limit(10)
                    ->get();

        $posts = collect($posts)->map(function ($v, $k) use ($userId) {
            $like = Like::where('user_id', $userId)->where('post_id', $v->id)->first();
            $isLiked = true;
            if (collect($like)->isEmpty()) $isLiked = false;

            return collect($v)
                        ->put('is_liked', $isLiked)
                        ->except(['user_id']);
        });

        if (is_null($postId) && is_null($type)) $posts = $posts->reverse()->values();

        return $posts;
    }
}