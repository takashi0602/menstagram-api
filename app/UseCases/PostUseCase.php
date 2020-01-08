<?php

namespace App\UseCases;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
     */
    public function __invoke($filePaths)
    {
        DB::transaction(function () use ($filePaths) {
            User::where('id', user()->id)->increment('posted');

            $postId = Post::create([
                'user_id' => user()->id,
                'images'  => $filePaths,
            ])->id;

            return [ 'post_id' => $postId, ];
        }, 5);
    }
}