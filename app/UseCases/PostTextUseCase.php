<?php

namespace App\UseCases;

use App\Models\Post;

/**
 * テキスト投稿
 *
 * Class PostTextUseCase
 * @package App\UseCases
 */
class PostTextUseCase
{
    /**
     * @param $userId
     * @param $request
     * @return bool
     */
    public function __invoke($userId, $request)
    {
        $post = Post::where('user_id', $userId)->where('id', $request->post_id)->where('text', null)->first();
        if (collect($post)->isEmpty()) return false;

        $post->update([
            'text' => $request->text,
        ]);
        return true;
    }
}