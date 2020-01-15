<?php

namespace App\UseCases;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
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
     * @return array
     */
    public function __invoke($filePaths)
    {
        // TODO: ラーメン判定を実装するまでの暫定的な措置
        $isRamen = Arr::random([true, false]);

        $postId = 0;
        if ($isRamen) {
            $postId = DB::transaction(function () use ($filePaths) {
                User::where('id', user()->id)->increment('posted');

                $postId = Post::create([
                    'user_id' => user()->id,
                    'images'  => $filePaths,
                ])->id;

                return $postId;
            }, 5);
        }

        return [
            'post_id'  => $postId,
            'is_ramen' => $isRamen,
        ];
    }
}