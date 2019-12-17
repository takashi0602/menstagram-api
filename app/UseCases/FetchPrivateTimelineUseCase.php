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
     * @param null $postId
     * @param null $type
     * @return Post[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function __invoke($postId = null, $type = null)
    {
        $userId = user()->id;

        $followIds = collect(Follow::where('user_id', $userId)->get())->map(function ($v, $k) {
            return $v->target_user_id;
        })->push($userId);

        $query = Post::with(['user:id,user_id,screen_name,avatar']);

        if (is_null($postId) && is_null($type))                             $query->latest('id');
        else if (!is_null($postId) && (is_null($type) || $type === 'new'))  $query->where('id', '>=', $postId);
        else if (!is_null($postId) && $type === 'old')                      $query->where('id', '<=', $postId)->orderBy('id', 'desc');

        $posts = $query
                    ->whereIn('user_id', $followIds)
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

        if ($type === 'old') $posts = $posts->reverse()->values();

        return $posts;
    }
}