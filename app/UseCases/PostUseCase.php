<?php

namespace App\UseCases;

use App\Models\Post;

/**
 * 画像パスの保存
 *
 * Class PostImagesUseCase
 * @package App\UseCases
 */
class PostUseCase
{
    /**
     * @param $filePaths
     * @return array
     */
    public function __invoke($filePaths)
    {
        $postId = Post::create([
            'user_id'   => user()->id,
            'images'    => $filePaths,
        ])->id;

        return [
            'post_id' => $postId,
        ];
    }
}