<?php

namespace App\UseCases;

use App\Models\Post;

/**
 * Class PostImagesUseCase
 * @package App\UseCases
 */
class PostImagesUseCase
{
    /**
     * 画像パスの保存
     *
     * @param $userId
     * @param $filePaths
     * @return array
     */
    public function __invoke($userId, $filePaths)
    {
        $postId = Post::create([
            'user_id'   => $userId,
            'images'    => $filePaths,
        ])->id;

        return [
            'post_id' => $postId,
        ];
    }
}