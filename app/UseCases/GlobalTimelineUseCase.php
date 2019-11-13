<?php

namespace App\UseCases;

use App\Models\Post;

/**
 * グローバルタイムライン
 *
 * Class GlobalTimelineUseCase
 * @package App\UseCases
 */
class GlobalTimelineUseCase
{
    /**
     * @param $postId
     * @return Array
     */
    public function __invoke($postId)
    {
        if ($postId != NULL){
            $posts = Post::where('id', '<', $postId)->orderBy('id', 'DESC')->limit(32)->get();
        }else{
            $posts = Post::orderBy('id', 'DESC')->limit(32)->get();
        }
        $array=[];
        foreach ($posts as $key => $post) {
            $array[] = [
                "id"=> $post->id,
                "text"=> $post->text,
                "images"=> $post->images,
                "user"=> [
                    "user_id"=> $post->user->user_id,
                    "screen_name"=> $post->user->screen_name,
                    "avatar"=> $post->user->avatar
                ],
                "liked"=> $post->liked,
                "created_at"=> $post->created_at,
                "updated_at"=> $post->updated_at
            ];
        }
        return $array;
    }
}