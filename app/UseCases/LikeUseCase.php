<?php

namespace App\UseCases;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

/**
 * いいね
 *
 * Class LikeUseCase
 * @package App\UseCases
 */
class LikeUseCase
{
    /**
     * @param $userId
     * @param $postId
     * @return bool
     */
    public function __invoke($userId, $postId)
    {
        $like = Like::where('user_id', $userId)->where('post_id', $postId)->get();
        if (collect($like)->isNotEmpty()) return false;

        DB::transaction(function () use ($userId, $postId) {
            Post::where('id', $postId)->increment('liked');

            Like::create([
                'user_id'=> $userId,
                'post_id'=> $postId,
            ]);
        }, 5);

        return true;
    }
}