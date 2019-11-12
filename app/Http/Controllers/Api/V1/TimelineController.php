<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\TimelineUserRequest;
use App\UseCases\TimelineUserUseCase;

use App\Models\User;
use App\Models\Post;


/**
 * タイムラインAPI
 * 
 * Class TimelineController
 * @package App\Http\Controllers\Api\V1
 */
class TimelineController extends Controller
{
    /**
     * グローバルタイムライン
     * 
     * @param 
     */
    function global(Request $request){
        $posts = Post::limit(32)->get();
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
