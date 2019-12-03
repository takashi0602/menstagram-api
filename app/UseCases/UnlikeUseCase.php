<?php

namespace App\UseCases;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

/**
 * いいねを外す
 *
 * Class UnlikeUseCase
 * @package App\UseCases
 */
class UnlikeUseCase
{
    /**
     * @param $userId
     * @param $postId
     * @return bool
     */
    public function __invoke($userId, $postId)
    {
        $like = Like::where('user_id', $userId)->where('post_id', $postId)->get();
        if (collect($like)->isEmpty()) return false;

        DB::transaction(function () use ($userId, $postId) {
            Post::where('id', $postId)->decrement('liked');
            Like::where('user_id', $userId)->where('post_id', $postId)->delete();
        }, 5);

        return true;
    }
}