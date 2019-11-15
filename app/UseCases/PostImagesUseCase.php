<?php

namespace App\UseCases;

use App\Models\Post;
use App\Models\User;

/**
 * 画像パスの保存
 *
 * Class PostImagesUseCase
 * @package App\UseCases
 */
class PostImagesUseCase
{
    /**
     * @param $accessToken
     * @param $filePaths
     * @return array
     */
    public function __invoke($accessToken, $filePaths)
    {
        $userId = User::where('access_token', $accessToken)->first()->id;

        $postId = Post::create([
            'user_id'   => $userId,
            'images'    => $filePaths,
        ])->id;

        return [
            'post_id' => $postId,
        ];
    }
}