<?php

namespace App\UseCases;

use App\Models\Post;
use App\Models\User;

/**
 * 投稿
 *
 * Class PostUseCase
 * @package App\UseCases
 */
class PostUseCase
{
    /**
     * @param $accessToken
     * @param $request
     */
    public function __invoke($accessToken, $request)
    {
        $userId = User::where('access_token', $accessToken)->first()->id;

        Post::where('user_id', $userId)->where('id', $request->post_id)->where('text', null)->update([
            'text' => $request->text,
        ]);
    }
}