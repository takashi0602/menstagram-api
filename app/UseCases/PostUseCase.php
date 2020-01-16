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
     * @param $isRamens
     * @return array
     */
    public function __invoke($filePaths, $isRamens)
    {
        $postId = 0;
        if (collect($isRamens)->contains(true)) {
            $postId = DB::transaction(function () use ($filePaths, $isRamens) {
                User::where('id', user()->id)->increment('posted');

                $postId = Post::create([
                    'user_id' => user()->id,
                    'images'  => $this->filteredFilePaths($filePaths, $isRamens),
                ])->id;

                return $postId;
            }, 5);
        }

        return [
            'post_id'  => $postId,
            'is_ramens' => $isRamens,
        ];
    }

    /**
     * isRamensの真偽値に基づいてfilePathsをフィルタにかける
     *
     * @param $filePaths
     * @param $isRamens
     * @return array
     */
    private function filteredFilePaths($filePaths, $isRamens)
    {
        $filteredFilePaths = [];
        for ($i = 0; $i < count($filePaths); $i++) {
            if ($isRamens) $filteredFilePaths[] = $filePaths[$i];
        }
        return $filteredFilePaths;
    }
}